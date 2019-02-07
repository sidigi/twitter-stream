<?php
declare(strict_types = 1);

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Thujohn\Twitter\Facades\Twitter;

/**
 * @property int                 $id
 * @property string              $key
 * @property string              $value
 */
class Option extends Model
{
    public const IMAGES_MODE = 'images';
    public const TWEETS_MODE = 'tweets';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public static function set(string $key, string $val){
        self::updateOrCreate([
            'key' => $key,
        ],
        [
            'value' => $val,
        ]);
    }

    public static function get(string $key){
        $option = self::select('value')->where('key', $key)->first();

        return $option ? $option->value : null;
    }
}
