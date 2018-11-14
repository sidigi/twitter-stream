<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('manager')) {
            $tweets = Tweet::orderBy('created_at','desc')->paginate(25);

            $tweets->map(function ($item, $key){
                $item->tweet_text = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $item->tweet_text);
                $item->tweet_text = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $item->tweet_text);
                $item->tweet_text = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $item->tweet_text);
            });

            return view('admin.tweets.index', compact('tweets'));
        }
    }

    public function create()
    {
        return view('admin.tweets.create');
    }

    public function store(Request $request)
    {
        $msg = \App\Service\TwitterService::addFromForm($request->tweet);

        return redirect()->back()->with(['success'=> $msg]);
    }

    public function show(Tweet $tweet)
    {

    }

    public function edit(Tweet $tweet)
    {

    }

    public function update(Request $request, Tweet $tweet)
    {

    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
    }

    public function approve(Tweet $tweet)
    {
        $tweet->approved = true;
        $tweet->save();
    }

    public function moderate(Tweet $tweet)
    {
        $tweet->moderated = true;
        $tweet->save();
    }

    public function unApprove(Tweet $tweet)
    {
        $tweet->approved = false;
        $tweet->save();
    }
}
