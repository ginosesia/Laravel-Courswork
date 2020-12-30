<?php

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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/profile', function() {
    return view('profile');
})->name('post');
Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');
Route::resource('notifications', 'Notifications');
Route::get('markAsRead', function() {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');
Route::get('clearAllNotifications', function() {
    auth()->user()->notifications()->delete();
    return redirect()->back();
})->name('clearAll');
Route::post('comments{post_id}',['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');