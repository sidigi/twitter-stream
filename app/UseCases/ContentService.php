<?php
declare(strict_types=1);

namespace App\UseCases;

use App\Models\Content\Content;
use App\Models\Content\Image\Image;
use App\Models\Content\Meta;
use App\Models\Content\Video\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ContentService
{
    public function createVideo(string $url, Meta $meta): void
    {
        DB::transaction(static function () use ($url, $meta){
            /** @var Video $video */
            $video = Video::add($url);

            Content::add($video, $meta);
        });
    }

    public function createImage(object $file, Meta $meta): void
    {
        DB::transaction(function () use ($file, $meta){
            /** @var Image $image */
            $image = Image::add($file);

            Content::add($image, $meta);
        });
    }

    public function delete(int $contentId){
        /** @var Content $content */
        $content = Content::findOrFail($contentId);

        $content->delete();
    }

    public static function guessContent(): ?Content
    {
        $curDate = Carbon::now();

        $content = Content::whereImmediate(true)->first();
        if ($content){
            return $content;
        }

        /** @var Content $content */
        $content = Content::where('date_from', '<=', $curDate)
            ->where('date_to', '>', $curDate)
            ->orderBy('date_from', 'desc')
            ->first();

        if (!$content){
            $content = Content::whereDefault(true)->first();
        }

        return $content;
    }
}