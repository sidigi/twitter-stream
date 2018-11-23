<?php

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::approved()
            ->take(25)
            ->get();

        return view('public.tweets.index', compact('tweets'));
    }
}
