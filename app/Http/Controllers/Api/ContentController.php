<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Models\Content\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Content as ContentResource;

class ContentController
{
    public function index(Request $request){
        $curDate = Carbon::now();

        /** @var Content $content */
        $content = Content::where('date_from', '<=', $curDate)
            ->where('date_to', '>', $curDate)
            ->orderBy('date_from', 'asc')
            ->first();

        if (!$content){
            $content = Content::whereDefault(true)->first();
        }

        if (!$content){
            $content = Content::select()->first();
        }

        return new ContentResource($content);
    }
}