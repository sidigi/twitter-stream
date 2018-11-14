<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tweet;

class TestController extends Controller
{
    public function index()
    {
        $tweets = Tweet::where('approved',1)->orderBy('created_at','desc')->take(25)->get();

        $mainTweet = $subTweet = null;

        return view('public.index', compact('tweets', 'mainTweet', 'subTweet'));
    }
}
