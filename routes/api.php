<?php
Route::group([
    'namespace' => 'Api',
    'as' => 'admin.',
], function () {
    Route::get('/config', 'ConfigController@get')->name('config.get');
    Route::get('/tweets', 'TweetsController@index')->name('tweets.index');
    Route::get('/images', 'ImagesController@index')->name('images.index');
});

