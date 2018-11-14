<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('created_at','desc');
        });
    }

    public function getMediaAttribute()
    {
        return $this->getFromMeta('media');
    }

    public function getTweetTextAttribute($value)
    {
        $value = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $value);
        $value = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $value);
        $value = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $value);

        return $value;
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
        return $query->where('approved', $value);
    }
}
