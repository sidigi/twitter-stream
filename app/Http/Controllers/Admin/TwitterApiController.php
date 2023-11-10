<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tweet\Tweet;
use Thujohn\Twitter\Facades\Twitter;

class TwitterApiController extends Controller
{
    public function get($id)
    {
        $tweet = (array) Twitter::getTweet($id);
        $tweet = json_decode(json_encode($tweet), true);

        $extendedTweet = (array) Twitter::getTweet($id, ['tweet_mode' => 'extended']);
        $extendedTweet = json_decode(json_encode($extendedTweet), true);

        $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
        $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
        $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
        $user_avatar_url = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;

        return new Tweet([
            'id' => $tweet['id_str'],
            'json' => $tweet + $extendedTweet,
            'tweet_text' => $tweet_text,
            'user_id' => $user_id,
            'user_screen_name' => $user_screen_name,
            'user_avatar_url' => $user_avatar_url,
            'approved' => false,
            'moderated' => false,
        ]);
    }

    public function show($id)
    {
        return view('twitter-api.detail', ['tweet' => $this->get($id)]);
    }
}
