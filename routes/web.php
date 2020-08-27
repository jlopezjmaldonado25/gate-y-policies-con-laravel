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

//Route::put('admin/posts/{post}', 'Admin\PostController@update')->middleware('can:update,post');
//Route::put('admin/posts/{post}', 'Admin\PostController@update');

Route::middleware('auth')->namespace('Admin\\')->group(function () {
    Route::post('admin/posts', 'PostController@store');

    Route::put('admin/posts/{post}', 'PostController@update');
});

Route::name('login')->get('login', function () {
    return 'Login';
});

Route::name('register')->get('register', function () {
    return 'Register';
});
