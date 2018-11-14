<?php
Route::get('twitter-api/tweet/{id}', 'TwitterApiController@get')->name('twitter-api.tweet.get');

Route::group([
        'prefix' => 'admin',
        'middleware' => 'auth',
        'as' => 'admin.',
        'namespace' => 'Admin'
    ], function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('test', 'TestController@index')->name('test.index');

        Route::post('tweets/{tweet}/approve', 'TweetController@approve')->name('tweets.approve');
        Route::post('tweets/{tweet}/unapprove', 'TweetController@unapprove')->name('tweets.unapprove');
        Route::post('tweets/{tweet}/moderate', 'TweetController@moderate')->name('tweets.moderate');
        Route::resource('tweets', 'TweetController');
});

Route::group([
    'namespace' => 'Pub'
], function () {
    Route::get('/', 'TweetController@index');
});

Auth::routes();