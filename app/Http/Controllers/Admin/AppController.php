<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option\Option;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function changeMode(Request $request): void
    {
        if ($request->has('content-mode')) {
            Option::setMode(Option::CONTENT_MODE);
            return;
        }

        Option::setMode(Option::TWEETS_MODE);
    }

    public function pauseVideo(Request $request): void
    {
        if ($request->has('pause')) {
            Option::setVideoMode(Option::VIDEO_PAUSE_MODE);
            return;
        }

        Option::setVideoMode(Option::VIDEO_PLAY_MODE);
    }
}