<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Image as ImageResource;
use App\Models\Image\Image;
use App\Models\Option\Option;
use Illuminate\Http\Request;

class ImagesController
{
    public function index(Request $request){
<<<<<<< HEAD
        $image = [
            'url' => Option::get('active-image')
        ];
=======
        $images = Image::whereId(Option::getActiveImageId())->get();
>>>>>>> images_storage

        if (!$images->count()){
            $images = Image::all();
        }

        return ImageResource::collection($images);
    }
}