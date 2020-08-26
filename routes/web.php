<?php

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

Route::get('/', function () {
    return view('welcome');
});

Route::put('admin/posts/{post}', function (Post $post, Request $request) {

   /*  if(auth()->guest()){
        abort('401');
    }

    if(auth()->user()->cant('update', $post)){
        abort('403');
    } */

   /*  if(Gate::denies('update', $post)){
        abort('403');
    } */

    $post->update([
        'title' => $request->title
    ]);

    return 'Post updated!';
})->middleware('can:update,post');

Route::name('login')->get('login', function () {
    return 'Login';
});

Route::name('register')->get('register', function () {
    return 'Register';
});
