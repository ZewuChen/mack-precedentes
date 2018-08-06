<?php

Route::group(['prefix' => 'precedentes'], function () {
    Route::get('/', 'PrecedentController@index')->name('precedent.index');
    Route::get('/create', 'PrecedentController@create')->name('precedent.create');
    Route::post('/store', 'PrecedentController@store');
    Route::post('/like', 'PrecedentController@like')->name('precedent.like');
    Route::post('/deslike', 'PrecedentController@deslike')->name('precedent.deslike');
    Route::post('/search', 'PrecedentController@search')->name('precedent.search');
    Route::get('{precedent}', 'PrecedentController@show')->name('precedent.show');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::put('/update', 'UserController@update')->name('user.update');
    Route::post('/password', 'UserController@password')->name('user.password');
    Route::get('/saves', 'SavesController@index')->name('save.index');
    Route::get('/meus-precedentes', 'SavesController@myPrecedents')->name('precedent.my');
    Route::post('/saves', 'SavesController@store')->name('precedent.save');
    Route::post('/saves/destroy', 'SavesController@destroy')->name('save.destroy');
});



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

Route::group(['prefix' => 'colecoes'], function () {
    Route::post('new', 'CollectionController@new')->name('collection.new');
    Route::post('create/{precedent}', 'CollectionController@store')->name('collection.create');
    Route::post('destroy/{precedent}', 'CollectionController@destroy')->name('collection.destroy');
    Route::get('{collection}', 'CollectionController@show')->name('collection.show');
});

Auth::routes();

Route::get('/redirect', 'FacebookController@redirect')->name('facebook.login');
Route::get('/callback', 'FacebookController@callback');

Route::get('/', 'HomeController@index')->name('home');