<?php
Route::group([
    'namespace' => 'Api',
    'as' => 'admin.',
], function () {
    Route::get('/config', 'ConfigController@get')->name('config.get');
    Route::get('/tweets', 'TweetsController@index')->name('tweets.index');
    Route::get('/content', 'ContentController@index')->name('content.index');
});

