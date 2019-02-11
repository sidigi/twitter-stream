<?php
declare(strict_types=1);

namespace App\Models\Content;

use App\Models\Content\Image\Image;
use App\Models\Content\Video\Video;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int                 $id
 * @property string              $content_type
 * @property int                 $content_id
 * @property boolean             $default
 * @property string              $type
 * @property Carbon              $date_from
 * @property Carbon              $date_to
 */
class Content extends Model
{
    public $table = 'content';

    protected $guarded = [];
    protected $casts   = [
        'id'          => 'integer',
        'default'     => 'boolean',
    ];

    protected $dates   = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to',
    ];

    public function getShowingAttribute(): bool
    {
        $now = Carbon::now();

        return $this->date_from->gt($now) && $this->date_to->lt($now);
    }

    public function getTypeAttribute(): ?string
    {
        if ($this->isImage()){
            return 'image';
        }

        if ($this->isVideo()){
            return 'video';
        }
    }

    public function isImage(): bool
    {
        return Image::class === $this->content_type;
    }

    public function isVideo(): bool
    {
        return Video::class === $this->content_type;
    }

    public function content(): MorphTo
    {
        return $this->morphTo();
    }

    public function markAsDefault(): void
    {
        self::query()->update(['default' => false]);

        $this->default = true;
        $this->save();
    }

    public static function add(Contentable $model, Meta $meta): Content
    {
        $model->save();

        /** @var Content $content */
        $content = new self;
        $content->fillWithMeta($meta);

        $model->content()->save($content);

        return $content;
    }

    private function fillWithMeta(Meta $meta): void
    {
        $this->default = $meta->default;
        $this->date_from = $meta->date_from;
        $this->date_to = $meta->date_to;
    }

    function delete()
    {
        $this->content->delete();

        parent::delete();
    }
}