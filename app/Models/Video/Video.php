<?php
declare(strict_types=1);

namespace App\Models\Video;

use App\Models\Content\Content;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int                 $id
 * @property string              $url
 */
class Video extends Model
{
    public $table = 'video';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public function getVideoIdAttribute(){
        parse_str( parse_url( $this->url, PHP_URL_QUERY ), $vars );

        return  $vars['v'];
    }

    public static function add(string $url)
    {
        return self::create([
            'url' => $url
        ]);
    }

    public function content()
    {
        return $this->morphMany(Content::class, 'contentable');
    }
}