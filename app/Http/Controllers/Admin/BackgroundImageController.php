<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackgroundImageController extends Controller
{
    public const PUBLIC_BACKGROUND_IMAGES = '/images/backgrounds/';

    public function index()
    {
        $files = File::allFiles(public_path(self::PUBLIC_BACKGROUND_IMAGES));

        $active = Option::get('active-background-image');

        $files = collect($files)->map(function(\SplFileInfo $item) use ($active){
            $pathname = self::PUBLIC_BACKGROUND_IMAGES . $item->getFilename();

            return (object) [
                'pathname' => $pathname,
                'name' => $item->getFilename(),
                'active' => $pathname === $active
            ];
        });

        return view('admin.background-images.index', compact('files'));
    }

    public function create()
    {
        return view('admin.background-images.create');
    }

    public function fileUpload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path(self::PUBLIC_BACKGROUND_IMAGES);
        $image->move($destinationPath, $input['image']);

        return back()->with('success','Image Upload successful');
    }

    public function deleteImage(Request $request){
        if ($request->has('pathname')) {
            File::delete(public_path($request->pathname));
        }
    }

    public function activeImage(Request $request){
        if ($request->has('pathname')) {
            Option::set('active-background-image', $request->pathname);
        }
    }
}