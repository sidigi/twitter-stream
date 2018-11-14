<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Thujohn\Twitter\Facades\Twitter;

/**
 * @property int                 $id
 * @property string              $json
 * @property string              $tweet_test
 * @property int                 $user_id
 * @property string              $user_screen_name
 * @property string              $user_avatar_url
 * @property boolean             $approved
 * @property boolean             $moderated
 */
class Tweet extends Model
{
    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'json'        => 'array',
    ];

    public function getMediaAttribute()
    {
        return $this->getFromMeta('media');
    }

    public function getFromMeta(string $key)
    {
        $json = $this->json;
        if (! is_array($json)){
            $json = json_decode($json, true);
        }

        return find_in_arr_recursive($json, $key);
    }

    public function scopeApproved($query, $value = true)
    {
        return $query->where('approved', $value)->orderBy('created_at','desc');
    }

    public static function saveById($id){
        if (! $id){
            throw new \Exception('Tweet id not found');
        }

        $tweet = (array) Twitter::getTweet($id);
        $tweet = json_decode(json_encode($tweet), true);

        $extendedTweet = (array) Twitter::getTweet($id, ['tweet_mode' => 'extended']);
        $extendedTweet = json_decode(json_encode($extendedTweet), true);

        $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
        $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
        $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
        $user_avatar_url = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;

        if (isset($tweet['id'])) {
            self::updateOrCreate(['id' => $tweet['id']], [
                'id' => $tweet['id_str'],
                'json' => json_encode($tweet + $extendedTweet),
                'tweet_text' => $tweet_text,
                'user_id' => $user_id,
                'user_screen_name' => $user_screen_name,
                'user_avatar_url' => $user_avatar_url,
                'approved' => false,
                'moderated' => false,
            ]);

            return "updated tweet with id {$tweet['id']}";
        }

        return 'tweet not found';
    }
}
