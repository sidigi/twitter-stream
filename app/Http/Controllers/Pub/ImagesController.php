<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Models\Option\Option;
use App\Models\Tweet\Tweet;

class ImagesController extends Controller
{
    public function index()
    {
        return view('layouts.one_mode', ['mode' => Option::IMAGES_MODE]);
    }
}
