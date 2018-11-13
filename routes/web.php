<?php
use Thujohn\Twitter\Facades\Twitter;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        if (auth()->user()->hasRole('manager')) {
            $tweets = App\Tweet::orderBy('created_at','desc')->paginate(25);

            $tweets->map(function ($item, $key){
                $item->json = json_decode($item->json, true);

                $media = [];
                recursive($item->json, 'media', $media);

                if ($media){
                    $item->media = $media;
                }

                $item->tweet_text = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $item->tweet_text);
                $item->tweet_text = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $item->tweet_text);
                $item->tweet_text = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $item->tweet_text);
            });

            return view('admin.index', compact('tweets'));
        }
    });

    Route::get('/tweet/add', function () {
        return view('admin.tweet.add');
    });

    Route::post('/tweet/add', function (\Illuminate\Http\Request $request) {
        $msg = \App\Service\TwitterService::addFromForm($request->tweet);

        return redirect()->back()->with(['success'=> $msg]);
    })->name('admin.tweet.store');

    Route::get('/tweet/{id}', function ($id) {
        $tweet = (array) Twitter::getTweet($id);
        $tweet = json_decode(json_encode($tweet), true);

        $extendedTweet = (array) Twitter::getTweet($id, ['tweet_mode' => 'extended']);
        $extendedTweet = json_decode(json_encode($extendedTweet), true);

        $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
        $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
        $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
        $user_avatar_url = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;

        $media = [];
        recursive($extendedTweet, 'media', $media);

        return view('admin.tweet.tweet', ['tweet' => (object) [
            'id' => $tweet['id_str'],
            'json' => json_encode($tweet + $extendedTweet),
            'tweet_text' => $tweet_text,
            'user_id' => $user_id,
            'user_screen_name' => $user_screen_name,
            'user_avatar_url' => $user_avatar_url,
            'approved' => false,
            'moderated' => false,
            'media' => $media,
        ]]);
    })->name('tweet.detail');

    Route::get('/test', function () {
        $tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->take(25)->get();

        $tweets->map(function ($item, $key){
            $item->json = json_decode($item->json, true);
            if (isset($item->json['extended_entities']) && isset($item->json['extended_entities']['media'])){
                $item->media = $item->json['extended_entities']['media'];
            }
        });

        $mainTweet = $subTweet = null;

        return view('public.index', compact('tweets', 'mainTweet', 'subTweet'));
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

    Route::post('delete-tweet', ['middleware' => 'auth', function (Illuminate\Http\Request $request) {
        $tweetId = $request->get('tweet_id');
        if ($tweetId){
            App\Tweet::where('id', $tweetId)->delete();
        }

        if (!$request->ajax()){
            return redirect()->back();
        }
    }]);
});

Route::get('/', function () {
    if (auth()->check() && auth()->user()->hasRole('manager')) {
        return redirect('/admin');
    } else {

        $tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->take(25)->get();

        $tweets->map(function ($item, $key){
            $item->json = json_decode($item->json, true);

            $media = [];
            recursive($item->json, 'media', $media);

            if ($media){
                $item->media = $media;
            }

            $item->tweet_text = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $item->tweet_text);
            $item->tweet_text = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $item->tweet_text);
            $item->tweet_text = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $item->tweet_text);
        });

        $mainTweet = $subTweet = null;

        return view('public.index', compact('tweets', 'mainTweet', 'subTweet'));
    }
});

Auth::routes();