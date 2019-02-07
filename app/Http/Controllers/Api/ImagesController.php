<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Tweet as TweetResource;
use App\Models\Option\Option;
use App\Models\Tweet\Tweet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImagesController
{
    public function index(Request $request){
        $image = [
            'url' => Option::get('active-image')
        ];

        return [
            'data' => [$image]
        ];
    }
}