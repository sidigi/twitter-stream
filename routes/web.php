<?php
Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth', 'manager'],
        'as' => 'admin.',
        'namespace' => 'Admin'
    ], function () {
        Route::get('/', 'IndexController@index')->name('index');

        Route::post('tweets/{tweet}/approve', 'TweetController@approve')->name('tweets.approve');
        Route::post('tweets/{tweet}/unapprove', 'TweetController@unapprove')->name('tweets.unapprove');
        Route::post('tweets/{tweet}/moderate', 'TweetController@moderate')->name('tweets.moderate');
        Route::post('tweets/delete-no-moderated', 'TweetController@deleteNoModerate')->name('tweets.delete-no-moderated');
        Route::resource('tweets', 'TweetController');

        Route::get('twitter-api/tweet/{id}', 'TwitterApiController@show')->name('api.twitter.tweet.show');
        Route::get('api/twitter/tweet/{id}', 'TwitterApiController@get')->name('api.twitter.tweet.get');

        Route::post('content/{content}/mark-default', 'ContentController@markDefault')->name('content.mark-default');
        Route::post('content/{content}/mark-immediate', 'ContentController@markImmediate')->name('content.mark-immediate');
        Route::resource('content', 'ContentController');

        Route::post('app/change-mode', 'AppController@changeMode')->name('app.change-mode');
});

Route::group([
    'namespace' => 'Pub'
], function () {
    Route::get('/', 'MainController@index')->name('home');
    Route::get('/tweets', 'TweetController@index')->name('tweets');
    Route::get('/content', 'ContentController@index')->name('content');
});

Auth::routes();