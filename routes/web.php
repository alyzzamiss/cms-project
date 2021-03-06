<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['show', 'create', 'store']]);

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});

Route::namespace('Author')->prefix('author')->name('author.')->middleware('can:manage-blogs')->group(function(){
    Route::resource('/blogs', 'BlogsController');
});

Route::namespace('User')->prefix('user')->name('user.')->middleware('can:manage-comments')->group(function(){
    Route::resource('/comments', 'CommentsController');
});
