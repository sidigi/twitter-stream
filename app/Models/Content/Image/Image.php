<?php
declare(strict_types=1);

namespace App\Models\Content\Image;

use App\Models\Content\Content;
use App\Models\Content\Contentable;
use App\Models\Option\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

/**
 * @property int                 $id
 * @property string              $path
 */
class Image extends Model implements Contentable
{
    public const PUBLIC_BACKGROUND_IMAGES = '/images/backgrounds';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public static function add(object $file): Image
    {
        $path = Storage::putFile(self::PUBLIC_BACKGROUND_IMAGES, $file);

        return self::create([
            'path' => $path
        ]);
    }

    public function content(): MorphMany
    {
        return $this->morphMany(Content::class, 'content');
    }

    function delete()
    {
        Storage::delete($this->path);

        parent::delete();
    }
}