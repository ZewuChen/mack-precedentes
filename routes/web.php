<?php

Route::group(['prefix' => 'precedentes'], function () {
    Route::get('/', 'PrecedentController@index')->name('precedent.index');
    Route::get('/novo', 'PrecedentController@create')->name('precedent.create');
    Route::post('/novo', 'PrecedentController@store');
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

Route::group(['prefix' => 'tribunais'], function () {
    Route::get('{court}', 'CourtController@show')->name('court.show');
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('{tag}', 'TagController@show')->name('tag.show');
});

Route::group(['prefix' => 'types'], function () {
    Route::get('{precedentType}', 'PrecedentTypeController@show')->name('type.show');
});

Route::group(['prefix' => 'comentarios'], function () {
    Route::post('create/{precedent}', 'CommentController@store')->name('comment.create');
    Route::post('status/{comment}', 'CommentController@status')->name('comment.status');
    Route::get('{comment}', 'CommentController@show')->name('comment.show');
});

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