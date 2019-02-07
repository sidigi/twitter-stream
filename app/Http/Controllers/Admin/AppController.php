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
        if ($request->has('mode')) {
            Option::setMode($request->mode);
        }
    }
}