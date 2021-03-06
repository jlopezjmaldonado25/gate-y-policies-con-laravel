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

Route::get('posts/{post}', 'PostController@show');

Route::post('accept-terms', 'AcceptTermsController@accept');

Route::middleware('auth')->namespace('Admin\\')->prefix('admin/')->group(function () {
    Route::get('posts', 'PostController@index');

    Route::post('posts', 'PostController@store');

    Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');

    Route::put('posts/{post}', 'PostController@update');

    Route::delete('posts/{post}', 'PostController@delete');
});

//Route::name('login')->get('login', function () {
    //return 'Login';
//});

//Route::name('register')->get('register', function () {
    //return 'Register';
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
