<?php

// Precedents
Route::group(['prefix' => 'precedentes'], function () {
    Route::get('saved', 'PrecedentController@saved')->name('precedents.saved');
    Route::get('mine', 'SavesController@myPrecedents')->name('precedents.mine');
    Route::get('search', 'PrecedentController@search')->name('precedents.search');
    Route::post('{precedent}/save', 'SavesController@save')->name('precedents.save');
    Route::post('{precedent}/unsave', 'SavesController@unsave')->name('precedents.unsave');
});
Route::resource('precedents', 'PrecedentController')
    ->only('create', 'store', 'destroy', 'show', 'index');

// Users
Route::group(['prefix' => 'users'], function () {
    Route::patch('update', 'UserController@update')->name('users.update');
    Route::patch('password', 'UserController@updatePassword')->name('users.password.update');
});
Route::get('profile', 'UserController@profile')->name('profile');

// Precedent Types
Route::resource('types', 'PrecedentTypeController')
    ->only('show');

// Courts
Route::resource('courts', 'CourtController')
    ->only('show');

// Tags
Route::resource('tags', 'TagController')
    ->only('show');

// Comments
Route::patch('comments/{comment}/approve', 'CommentController@approve')
    ->name('comments.approve');
Route::resource('comments', 'CommentController')
    ->only('show', 'store', 'destroy');

// Collections
Route::group(['prefix' => 'collections'], function () {
    Route::post('{collection}/add', 'CollectionController@add')->name('collections.add');
    Route::post('new', 'CollectionController@new')->name('collections.new');
    Route::post('destroy/{precedent}', 'CollectionController@destroy')->name('collections.destroy');
});
Route::resource('collections', 'CollectionController')
    ->only('store', 'show');




Auth::routes();

Route::get('/redirect', 'FacebookController@redirect')->name('facebook.login');
Route::get('/callback', 'FacebookController@callback');

Route::get('/', 'HomeController@index')
    ->name('home');