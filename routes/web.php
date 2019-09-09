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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// public

Route::get('/post/{id}', 'AdminPostsController@post')->name('home.post');


Route::get('/admin',function(){
    return view('admin.index');
});

// Route::name('admin.')->group(function(){
//     // we use Route::name to add prefix admin. to the route, to prevent route conflict with the front side
//     Route::resource('/admin/users', 'AdminUsersController');
// });

Route::group(['middleware'=>'admin'],function(){
    Route::name('admin.')->group(function(){
        // we use Route::name to add prefix admin. to the route, to prevent route conflict with the front side
        Route::resource('/admin/users', 'AdminUsersController');
        Route::resource('/admin/posts','AdminPostsController');
        Route::resource('/admin/categories','AdminCategoryController');
        Route::resource('/admin/media','AdminMediaController');
        Route::get('admin/media/upload',['as' => 'media.upload', 'uses' => 'AdminMediaController@store']);
        Route::resource('/admin/comments', 'PostCommentController');
        Route::resource('/admin/comments/replies', 'CommentRepliesController');
    });
});

Route::group(['middleware' => 'auth'], function(){
        Route::post('comment/reply','CommentRepliesController@createReply')->name('replies.create');

});

Route::get('/logout' , 'Auth\LoginController@logout');

