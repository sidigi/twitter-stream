<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image\Image;
use App\Models\Option\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackgroundImageController extends Controller
{
    public const PUBLIC_BACKGROUND_IMAGES = '/images/backgrounds';

    public function index()
    {
        $mode =  Option::get('mode');

        $images = Image::all();

        return view('admin.background-images.index', compact('images', 'mode'));
    }

    public function create()
    {
        return view('admin.background-images.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $path = Storage::putFile(self::PUBLIC_BACKGROUND_IMAGES, $request->file('image'));

        try{
            Image::add($path);
        }catch (\Exception $e){
            Storage::delete($path);
            return back()->withErrors([$e->getMessage()]);
        }

        return back()->with('success','Image Upload successful');
    }

    public function destroy(Image $image): void
    {
        Storage::delete($image->path);
        $image->delete();
    }

    public function active(Request $request): void
    {
        $image = Image::findOrFail($request->id);
        Option::setActiveImage($image->id);
    }
}