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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::namespace('Home')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('topics', 'TopicsController',['only'=>['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::get('topics/{topic}/{slug?}','TopicsController@show')->name('topics.show');
    Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
    Route::resource('tags', 'TagsController', ['only' => ['show']]);
    Route::resource('users', 'UsersController');
    Route::get('users/{user}/follow_fans', 'UsersController@userFollowOrFans')->name('users.follow_fans');
    Route::get('users/{user}/topics', 'UsersController@userTopics')->name('users.topics');
    Route::get('users/{user}/replies', 'UsersController@userReplies')->name('users.replies');
    Route::get('users/{user}/vote_collect_topics', 'UsersController@userVoteOrCollectTopics')->name('users.vote_collect_topics');
    Route::get('users/{user}/edit_avatar', 'UsersController@editAvatar')->name('users.edit_avatar');
    Route::put('users/{user}/update_avatar', 'UsersController@updateAvatar')->name('users.update_avatar');
    Route::get('users/{user}/edit_password', 'UsersController@editPassword')->name('users.edit_password');
    Route::put('users/{user}/update_password', 'UsersController@updatePassword')->name('users.update_password');
    Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
    Route::get('about','AboutsController@about')->name('abouts.index');
    Route::get('search','SearchController@index')->name('search.index');
});


