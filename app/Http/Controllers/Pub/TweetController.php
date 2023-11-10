<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Models\Option\Option;

class TweetController extends Controller
{
    public function index()
    {
        return view('layouts.one_mode', ['mode' => Option::TWEETS_MODE]);
    }
}
