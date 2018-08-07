<?php

Route::group(['prefix' => 'precedentes'], function () {
    Route::get('/', 'PrecedentController@index')->name('precedent.index');
    Route::get('/create', 'PrecedentController@create')->name('precedent.create');
    Route::post('/store', 'PrecedentController@store');
    Route::post('/search', 'PrecedentController@search')->name('precedent.search');
    Route::get('{precedent}', 'PrecedentController@show')->name('precedent.show');
});

Route::resource('precedents', 'PrecedentController')
    ->only('destroy');

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::put('/update', 'UserController@update')->name('user.update');
    Route::post('/password', 'UserController@password')->name('user.password');
    Route::get('/saved', 'SavesController@index')->name('save.index');
    Route::get('/meus-precedentes', 'SavesController@myPrecedents')->name('precedent.my');
});

Route::post('precedents/{precedent}/save', 'SavesController@save')->name('precedents.save');
Route::post('precedents/{precedent}/unsave', 'SavesController@unsave')->name('precedents.unsave');

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