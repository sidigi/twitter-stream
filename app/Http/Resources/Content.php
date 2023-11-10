<?php
declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Option\Option;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int                 $id
 * @property string              $content_type
 * @property int                 $content_id
 * @property boolean             $default
 * @property string              $type
 * @property Carbon              $date_from
 * @property Carbon              $date_to
 */
class Content extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $return = [
            'type' => $this->type
        ];

        if ($this->isImage()){
            $return += $this->getFieldsForImage();
        }

        if ($this->isVideo()){
            $return += $this->getFieldsForVideo();
        }

        return $return;
    }

    private function getFieldsForImage(): array
    {
        return ['src' => asset('storage/' . $this->content->path)];
    }

    private function getFieldsForVideo(): array
    {
        return [
            'video_id' => $this->content->videoId,
        ];
    }
}
