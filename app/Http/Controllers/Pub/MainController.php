<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Models\Tweet\Tweet;

class MainController extends Controller
{
    public function index()
    {
        return view('layouts.public');
    }
}