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
        //$tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->take(22)->get();
        $tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->paginate(25);

        $tweets->map(function ($item, $key){
            $item->json = json_decode($item->json, true);
            if (isset($item->json['extended_entities']) && isset($item->json['extended_entities']['media'])){
                $item->media = $item->json['extended_entities']['media'];
            }
        });

        $mainTweet = $subTweet = null;

        if ($tweets){
            $mainTweet = $tweets->shift();
        }
        if ($tweets){
            $subTweet = $tweets->shift();
        }

        return view('welcome', compact('tweets', 'mainTweet', 'subTweet'));
    }
});

Route::post('approve-tweets', ['middleware' => 'auth', function (Illuminate\Http\Request $request) {
    foreach ($request->all() as $input_key => $input_val) {
        if ( strpos($input_key, 'approval-status-') === 0 ) {
            $tweet_id = substr_replace($input_key, '', 0, strlen('approval-status-'));
            $tweet = App\Tweet::where('id',$tweet_id)->first();
            if ($tweet) {
                $tweet->approved = (int)$input_val;
                $tweet->save();
            }
        }
    }

    if (!$request->ajax()){
        return redirect()->back();
    }
}]);

Auth::routes();

Route::get('/home', 'HomeController@index');
