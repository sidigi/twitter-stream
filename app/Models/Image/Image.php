<?php
declare(strict_types=1);

namespace App\Models\Image;

use App\Models\Option\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int                 $id
 * @property string              $path
 */
class Image extends Model
{
    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
    ];

    public function getActiveAttribute(): bool
    {
        return $this->id === Option::getActiveImageId();
    }

    public static function add(string $path)
    {
        Storage::exists($path);

        return self::create([
            'path' => $path
        ]);
    }
}