<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', App\Http\Livewire\Home::class)->name('home');
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', App\Http\Livewire\Login::class)->name('login');
    Route::get('/register', App\Http\Livewire\Register::class);
});

