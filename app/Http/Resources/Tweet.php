<?php
declare(strict_types = 1);

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int                 $id
 * @property string              $json
 * @property string              $tweet_text
 * @property int                 $user_id
 * @property string              $user_screen_name
 * @property string              $user_avatar_url
 * @property boolean             $approved
 * @property boolean             $moderated
 * @property Carbon              $created_at
 * @property array               $media
 */
class Tweet extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_screen_name,
            'avatar_url' => $this->user_avatar_url,
            'text' => $this->tweet_text,
            'media' => $this->media,
            'created_at' => $this->created_at
        ];
    }
}
