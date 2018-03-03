<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;
use TwitterStreamingApi;

class ListenForHashTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:listen-for-hash-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for hashtags being used on Twitter';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        TwitterStreamingApi::publicStream()
            ->whenHears(config('laravel-twitter-streaming-api.hash'), function (array $tweet) {
                $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
                $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
                $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
                $user_avatar_url = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;

                if (isset($tweet['id'])) {
                    Tweet::create([
                        'id' => $tweet['id_str'],
                        'json' => json_encode($tweet),
                        'tweet_text' => $tweet_text,
                        'user_id' => $user_id,
                        'user_screen_name' => $user_screen_name,
                        'user_avatar_url' => $user_avatar_url,
                        'approved' => 0
                    ]);

                    var_dump('added tweet with id' . $tweet['id']);
                }
            })
            ->startListening();
    }
}
