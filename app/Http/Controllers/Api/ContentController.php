<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Image as ImageResource;
use App\Models\Image\Image;
use App\Models\Option\Option;
use Illuminate\Http\Request;

class ContentController
{
    public function index(Request $request){
        return ['data' =>
            [
                [
                    'type' => 'video',
                    'id' => 'FxBfaEKkCYQ',
                    'show' => true,
                ],
                [
                    'type' => 'image',
                    'src' => asset('storage/' . Image::whereId(Option::getActiveImageId())->first()->path),
                    'show' => false,
                ]
            ]
        ];

        /*$images = Image::whereId(Option::getActiveImageId())->get();

        if (!$images->count()){
            $images = Image::all();
        }

        return ImageResource::collection($images);*/
    }
}