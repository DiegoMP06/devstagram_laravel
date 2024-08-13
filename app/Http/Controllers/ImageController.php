<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function store(Request $request)	
    {
        $image = $request->file('file');
        $name = Str::uuid() . '.' . $image->extension();

        $manager = new ImageManager(Driver::class);

        $newImage = $manager->read($image);
        $newImage->cover(1000, 1000);

        if(!File::exists(Storage::path('uploads'))) {
            File::makeDirectory(Storage::path('uploads'));
        }

        $newImage->save(Storage::path('uploads/'.$name));

        return response()->json(['imagen' => $name]);
    }
}
