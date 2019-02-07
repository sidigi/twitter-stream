<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Tweet as TweetResource;
use App\Models\Tweet\Tweet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TweetsController
{
    public function index(Request $request){
        $tweetQuery = Tweet::approved()
                    ->limit(30)
                    ->latest();

        if ($request->last_tweet_date){
            $tweetQuery->where('created_at', '>', Carbon::make($request->last_tweet_date));
        }

        return TweetResource::collection($tweetQuery->get());
    }
}