<?php
declare(strict_types = 1);

namespace App\Models\Option;

use App\UseCases\ContentService;
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
    public const CONTENT_MODE = 'content';
    public const TWEETS_MODE = 'tweets';

    public const MODE_KEY = 'mode';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public static function getModeList(): array
    {
        return [
            self::CONTENT_MODE,
            self::TWEETS_MODE,
        ];
    }

    public static function set(string $key, string $val){
        self::updateOrCreate([
            'key' => $key,
        ],
        [
            'value' => $val,
        ]);
    }

    public static function setMode($mode){
        if (! in_array($mode, self::getModeList(), true)){
            throw new \DomainException($mode . ' is incorrect mode');
        }

        return self::set(self::MODE_KEY, $mode);
    }

    public static function get(string $key){
        $option = self::select('value')->where('key', $key)->first();

        return $option ? $option->value : null;
    }

    public static function getMode(): ?string
    {
        $mode = self::get(self::MODE_KEY);

        if ($mode === self::TWEETS_MODE){
            return $mode;
        }

        $content = ContentService::guessContent();

        if ($content){
            return self::CONTENT_MODE;
        }else{
            return self::TWEETS_MODE;
        }
    }
}
