<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ContentController
{
    public function index(Request $request)
    {
        return view('admin.content.index');
    }
}