<?php

Route::get('ntags', function () {
    return view('tags');
});

// Pages
Route::get('team', 'PageController@team')->name('team');
Route::get('definition', 'PageController@definition')->name('definition');
Route::get('proposal', 'PageController@proposal')->name('proposal');
// Route::get('scientific-methodology', 'PageController@scientificMethodology')->name('scientific-methodology');
Route::get('collection-methodology', 'PageController@collectionMethodology')->name('collection-methodology');
Route::get('patreon', 'PageController@patreon')->name('patreon');

// Precedents
Route::group(['prefix' => 'precedentes'], function () {
    Route::get('saved', 'PrecedentController@saved')->name('precedents.saved');
    Route::get('mine', 'SavesController@myPrecedents')->name('precedents.mine');
    Route::get('search', 'PrecedentController@search')->name('precedents.search');
    Route::post('{precedent}/save', 'SavesController@save')->name('precedents.save');
    Route::post('{precedent}/unsave', 'SavesController@unsave')->name('precedents.unsave');
    Route::post('{precedent}/like', 'PrecedentController@like')->name('precedent.like');
    Route::post('{precedent}/dislike', 'PrecedentController@dislike')->name('precedent.dislike');
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

// Branches
Route::resource('branches', 'BranchController')
    ->only('show');

// Comments
Route::group(['prefix' => 'comments'], function () {
    Route::post('{comment}/like', 'CommentController@like')->name('comment.like');
    Route::post('{comment}/dislike', 'CommentController@dislike')->name('comment.dislike');
});
Route::patch('comments/{comment}/approve', 'CommentController@approve')
    ->name('comments.approve');
Route::resource('comments', 'CommentController')
    ->only('show', 'store', 'destroy');

// Collections
Route::group(['prefix' => 'collections'], function () {
    Route::post('{collection}/add', 'CollectionController@add')->name('collections.add');
    Route::post('new', 'CollectionController@new')->name('collections.new');
    // Route::post('destroy/{precedent}', 'CollectionController@destroy')->name('collections.destroy');
});
Route::resource('collections', 'CollectionController')
    ->only('store', 'show', 'destroy');

// Auth
Auth::routes();

Route::get('redirect', 'FacebookController@redirect')->name('facebook.login');
Route::get('callback', 'FacebookController@callback');

Route::get('/', 'HomeController@index')
    ->name('home');

