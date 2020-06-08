<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Post Catergories Endpoints
Route::get('post-categories', 'Api\BlogCategoryController@index')->name('post_categories');
Route::post('post-categories/store', 'Api\BlogCategoryController@store')->name('post_categories.store');
Route::get('post-categories/{category}', 'Api\BlogCategoryController@show')->name('post_categories.show');
Route::post('post-categories/update/{category}', 'Api\BlogCategoryController@update')->name('post_categories.update');
Route::post('post-categories/delete/{category}', 'Api\BlogCategoryController@destroy')->name('post_categories.destroy');




// Post Endpoints
Route::get('posts', 'Api\BlogController@index')->name('posts');
Route::post('posts/store', 'Api\BlogController@store')->name('posts.store');
Route::get('posts/{post}', 'Api\BlogController@show')->name('posts.show');
Route::post('posts/update/{post}', 'Api\BlogController@update')->name('posts.update');
Route::post('posts/delete/{post}', 'Api\BlogController@destroy')->name('posts.destroy');




// Post Comment Endpoints
Route::get('post-comments', 'Api\BlogCommentController@index')->name('post_comments');
Route::post('post-comments/store', 'Api\BlogCommentController@store')->name('post_comments.store');
Route::get('post-comments/{comment}', 'Api\BlogCommentController@show')->name('post_comments.show');
Route::post('post-comments/update/{comment}', 'Api\BlogCommentController@update')->name('post_comments.update');
Route::post('post-comments/delete/{comment}', 'Api\BlogCommentController@destroy')->name('post_comments.destroy');


