<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::all();

        return view('admin.video.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);

        Video::add($request->url);

        return back()->with('success','Video added successful');
    }

    public function destroy(Video $video): void
    {
        $video->delete();
    }
}