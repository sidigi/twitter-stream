<?php
namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Tweet;

class MainController extends Controller
{
    public function index()
    {
        $tweets = Tweet::approved()
            ->take(25)
            ->get();

        return view('public.index', compact('tweets'));
    }
}