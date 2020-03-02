<?php
declare(strict_types = 1);

namespace App\Console\Commands;

use App\Models\Tweet\Tweet;
use Illuminate\Console\Command;

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
            ->whenHears(config('laravel-twitter-streaming-api.hash'), static function (array $tweet) {
                $tweet_text = $tweet['text'] ?? null;
                $user_id = $tweet['user']['id_str'] ?? null;
                $user_screen_name = $tweet['user']['screen_name'] ?? null;
                $user_avatar_url = $tweet['user']['profile_image_url_https'] ?? null;

                if (isset($tweet['id'])) {
                    Tweet::updateOrCreate(
                    ['id' => $tweet['id_str'],],
                    [
                        'json' => json_encode($tweet),
                        'tweet_text' => $tweet_text,
                        'user_id' => $user_id,
                        'user_screen_name' => $user_screen_name,
                        'user_avatar_url' => $user_avatar_url,
                        'approved' => 0,
                        'moderated' => 0
                    ]);

                    var_dump('|**************** added tweet with id' . $tweet['id']. '************|');
                }
            })
            ->startListening();
    }
}
