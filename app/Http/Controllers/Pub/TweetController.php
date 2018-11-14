<?php

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->hasRole('manager')) {
            return redirect('/admin');
        } else {

            $tweets = Tweet::where('approved',1)->orderBy('created_at','desc')->take(25)->get();

            $tweets->map(function ($item, $key){
                $item->tweet_text = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $item->tweet_text);
                $item->tweet_text = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $item->tweet_text);
                $item->tweet_text = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $item->tweet_text);
            });

            $mainTweet = $subTweet = null;

            return view('public.index', compact('tweets', 'mainTweet', 'subTweet'));
        }
    }
}
