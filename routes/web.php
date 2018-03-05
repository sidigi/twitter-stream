<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Thujohn\Twitter\Facades\Twitter;

Route::get('/', function () {
    if (auth()->check() && auth()->user()->hasRole('manager')) {
        $tweets = App\Tweet::orderBy('created_at','desc')->paginate(25);

        $tweets->map(function ($item, $key){
            $item->json = json_decode($item->json, true);
            if (isset($item->json['extended_entities']) && isset($item->json['extended_entities']['media'])){
                $item->media = $item->json['extended_entities']['media'];
            }
        });

        return view('welcome', compact('tweets'));
    } else {
        $tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->take(25)->get();

        $tweets->map(function ($item, $key){
            $item->json = json_decode($item->json, true);
            if (isset($item->json['extended_entities']) && isset($item->json['extended_entities']['media'])){
                $item->media = $item->json['extended_entities']['media'];
            }
        });

        $mainTweet = $subTweet = null;

        /*if ($tweets){
            $mainTweet = $tweets->shift();
        }
        if ($tweets){
            $subTweet = $tweets->shift();
        }

        return view('welcome', compact('tweets', 'mainTweet', 'subTweet'));*/
        return view(config('view.welcome_view'), compact('tweets', 'mainTweet', 'subTweet'));
    }
});

Route::get('/test-design', function () {
    $tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->take(25)->get();

    $tweets->map(function ($item, $key){
        $item->json = json_decode($item->json, true);
        if (isset($item->json['extended_entities']) && isset($item->json['extended_entities']['media'])){
            $item->media = $item->json['extended_entities']['media'];
        }
    });

    $mainTweet = $subTweet = null;

    return view(config('view.welcome_view'), compact('tweets', 'mainTweet', 'subTweet'));
});

Route::post('approve-tweets', ['middleware' => 'auth', function (Illuminate\Http\Request $request) {
    foreach ($request->all() as $input_key => $input_val) {
        if ( strpos($input_key, 'approval-status-') === 0 ) {
            $tweet_id = substr_replace($input_key, '', 0, strlen('approval-status-'));
            $tweet = App\Tweet::where('id',$tweet_id)->first();
            if ($tweet) {
                $tweet->approved = (int)$input_val;
                $tweet->moderated = true;
                $tweet->save();
            }
        }
    }

    if (!$request->ajax()){
        return redirect()->back();
    }
}]);

Route::get('/custom-tweet/save/{id}/', function($id){
    $tweet = (array) Twitter::getTweet($id);
    $tweet = json_decode(json_encode($tweet), true);

    $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
    $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
    $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
    $user_avatar_url = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;

    if (isset($tweet['id'])) {
        if (!App\Tweet::where('id', $tweet['id'])->first()){
            App\Tweet::create([
                'id' => $tweet['id_str'],
                'json' => json_encode($tweet),
                'tweet_text' => $tweet_text,
                'user_id' => $user_id,
                'user_screen_name' => $user_screen_name,
                'user_avatar_url' => $user_avatar_url,
                'approved' => 0,
                'moderated' => 0
            ]);
            return '|**************** added tweet with id ' . $tweet['id']. '************|';
        }
        return '|**************** already created ' . $tweet['id']. '************|';
    }

    return '|**************** tweet not found id: ' . $tweet['id']. '************|';
});

Auth::routes();

Route::get('/home', 'HomeController@index');
