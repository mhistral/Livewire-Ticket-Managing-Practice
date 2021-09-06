<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;

    // public $comments;

    public $newComment;
    public $image;
    public $ticketId;

    /**
     * this is called when emit is called in the livewire
     *
     * @var array
     */
    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected', //same value and function name
    ];


    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }
    /**
     * Runs once, immediately after the component is instantiated
     * we get the data from the database to show the comments
     *
     *
     * @param [type] $comments
     * @return void
     */
    // public function mount()
    // {
    //     // $initialComments = $comments = Comment::latest()->paginate(2);
    //     // $this->comments = $initialComments;
    // }


    /**
     * Runs before any update to the Livewire component's data
     * realtime validation
     * we removed the .lazy because we are calling this method whenever there's a changes in the input field
     *
     * @param [type] $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['newComment' => 'required|max:255']);
    }


    /**
     * we add new comment
     *
     * @return void
     */
    public function addComment(){

        /**
         * we are now validating the input, you can see the error in the commends.blade.php named newComment
         */
        $this->validate(['newComment' => 'required|max:255']);
        $image = $this->storeImage();
        if ($this->newComment == '') {
            return;
        }

        $createdComment = Comment::create([
            'body' => $this->newComment, 'user_id' => 1,
            'image' => $image,
            'support_ticket_id' => $this->ticketId,
        ]);
        // $this->comments->prepend($createdComment);
        $this->newComment = "";
        $this->image = "";

        session()->flash('message', 'Comments Succesfully Added!');
    }

    public function storeImage()
    {
        if(!$this->image){
            return null;
        }

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);

        return $name;
    }


    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();

        /**
         * we update the comments section without refreshing the page
         * since $this->comments are a collection, we can just return the collection by excluding the commentId
         */
        // $this->comments = $this->comments->where('id', '!=', $commentId);

        session()->flash('message', 'Comments Succesfully Deleted!');
    }

    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->paginate(2)
        ]);
    }
}
