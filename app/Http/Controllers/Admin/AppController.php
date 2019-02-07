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
        if ($request->has('image-mode')) {
            Option::setMode(Option::IMAGES_MODE);
            return;
        }

        Option::setMode(Option::TWEETS_MODE);
    }
}