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
    public const CONTENT_MODE = 'content';
    public const TWEETS_MODE = 'tweets';

    public const VIDEO_PAUSE_MODE = 'paused';
    public const VIDEO_PLAY_MODE = 'play';

    public const MODE_KEY = 'mode';
    public const VIDEO_KEY = 'video-mode';
    public const DEFAULT_CONTENT_KEY = 'default-content-id';

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

    public static function getVideoList(): array
    {
        return [
            self::VIDEO_PAUSE_MODE,
            self::VIDEO_PLAY_MODE,
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

    public static function setVideoMode($mode){
        if (! in_array($mode, self::getVideoList(), true)){
            throw new \DomainException($mode . ' is incorrect video mode');
        }

        return self::set(self::VIDEO_KEY, $mode);
    }

    public static function get(string $key){
        $option = self::select('value')->where('key', $key)->first();

        return $option ? $option->value : null;
    }

    public static function getActiveContentId(): ?int
    {
        return (int) self::get(self::DEFAULT_CONTENT_KEY);
    }

    public static function setActiveContent(int $id): void
    {
        self::set(self::DEFAULT_CONTENT_KEY, (string) $id);
    }

    public static function getMode(): ?string
    {
        return self::get(self::MODE_KEY);
    }

    public static function getVideoMode():string
    {
        return self::get(self::VIDEO_KEY) ?: 'play';
    }
}
