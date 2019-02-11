<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Models\Option\Option;

class ContentController extends Controller
{
    public function index()
    {
        return view('layouts.one_mode', ['mode' => Option::CONTENT_MODE]);
    }
}
