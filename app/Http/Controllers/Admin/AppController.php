<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function changeMode(Request $request){
        $mode = 'tweet-list';
        if ($request->has('mode')) {
            $mode = $request->mode;
        }

        Option::set('app-mode', $mode);
    }
}