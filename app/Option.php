<?php

namespace App;

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
