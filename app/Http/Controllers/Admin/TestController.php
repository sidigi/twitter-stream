<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tweet\Tweet;

class TestController extends Controller
{
    public function index()
    {
        $tweets = Tweet::approved()
            ->take(25)
            ->get();

        return view('public.index', compact('tweets'));
    }
}
