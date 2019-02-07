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

    public const MODE_KEY = 'mode';
    public const ACTIVE_IMAGE_KEY = 'active-image-id';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public static function getModeList(): array
    {
        return [
            self::IMAGES_MODE,
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

    public static function getActiveImageId(): ?int
    {
        return (int) self::get(self::ACTIVE_IMAGE_KEY);
    }

    public static function setActiveImage(int $id): void
    {
        self::set(self::ACTIVE_IMAGE_KEY, (string) $id);
    }
}
