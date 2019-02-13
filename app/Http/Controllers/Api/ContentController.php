<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\UseCases\ContentService;
use Illuminate\Http\Request;
use App\Http\Resources\Content as ContentResource;

class ContentController
{
    public function index(Request $request){
        $content = ContentService::guessContent();

        return new ContentResource($content);
    }
}