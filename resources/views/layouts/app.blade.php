
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script src="{{ asset('js/app.js') }}" data-turbolinks-eval="false"></script>
</body>
</head>

<body class="flex flex-wrap justify-center">

    <div class="flex w-full justify-between px-4 bg-purple-900 text-white">
        <a href="/" class="mx-3 py-4">Home</a>

        @auth
            @livewire('logout')
        @endauth


        @guest
        <div class="py-4">
            <a href="/login" class="">Login</a>
            <a href="/register" class="">Register</a>
        </div>
        @endguest

    </div>

    <div class="my-10 w-full flex justify-center">
        {{ $slot }}
    </div>

</body>
</html>





