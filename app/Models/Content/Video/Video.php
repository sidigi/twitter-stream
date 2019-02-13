<?php
declare(strict_types=1);

namespace App\Models\Content\Video;

use App\Models\Content\Content;
use App\Models\Content\Contentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int                 $id
 * @property string              $url
 */
class Video extends Model implements Contentable
{
    public $table = 'video';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public function getVideoIdAttribute(){
        if (strpos((string) $this->url, 'youtu.be') !== false){
            $parts = explode('/', $this->url);
            return end($parts);
        }
        try{
            parse_str( parse_url( (string) $this->url, PHP_URL_QUERY ), $vars );
        }catch(\Exception $e){

        }

        return  $vars['v'];
    }

    public static function add(string $url): Video
    {
        return self::create([
            'url' => $url
        ]);
    }

    public function content(): MorphMany
    {
        return $this->morphMany(Content::class, 'content');
    }
}