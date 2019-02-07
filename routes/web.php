<?php
Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth', 'manager'],
        'as' => 'admin.',
        'namespace' => 'Admin'
    ], function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('test', 'TestController@index')->name('test.index');

        Route::post('tweets/{tweet}/approve', 'TweetController@approve')->name('tweets.approve');
        Route::post('tweets/{tweet}/unapprove', 'TweetController@unapprove')->name('tweets.unapprove');
        Route::post('tweets/{tweet}/moderate', 'TweetController@moderate')->name('tweets.moderate');
        Route::post('tweets/delete-no-moderated', 'TweetController@deleteNoModerate')->name('tweets.delete-no-moderated');
        Route::resource('tweets', 'TweetController');

        Route::get('twitter-api/tweet/{id}', 'TwitterApiController@show')->name('api.twitter.tweet.show');
        Route::get('api/twitter/tweet/{id}', 'TwitterApiController@get')->name('api.twitter.tweet.get');

        Route::post('background-images/file-upload', 'BackgroundImageController@fileUpload')->name('background-image.file-upload');
        Route::post('background-images/active', 'BackgroundImageController@activeImage')->name('background-image.active-image');
        Route::delete('background-images/delete', 'BackgroundImageController@deleteImage')->name('background-image.delete-image');
        Route::resource('background-images', 'BackgroundImageController');

        Route::post('app/change-mode', 'AppController@changeMode')->name('app.change-mode');
});

Route::group([
    'namespace' => 'Pub'
], function () {
    Route::get('/', 'MainController@index')->name('home');
    Route::get('/tweets', 'TweetController@index')->name('tweets');
    Route::get('/background-images', 'ImagesController@index')->name('images');
});

Auth::routes();