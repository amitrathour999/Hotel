<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class GalleryController extends Controller
{
    public function gallery()
    {
        $galleries = collect();
        try {
            if (Schema::hasTable('galleries')) {
                $galleries = Gallery::latest()->paginate(6);
            }
        } catch (\Throwable $e) {
            $galleries = collect();
        }
        return view('Backend.gallery', compact('galleries'));
    }

    public function gallerycode(Request $request)
    {
        if (!Schema::hasTable('galleries')) {
            return back()->with('error', 'The galleries table does not exist in database yet. Please run: php artisan migrate');
        }

        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
            'image'    => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Ensure uploads directory exists
            $destinationPath = public_path('uploads/gallery');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = 'uploads/gallery/' . $imageName;

            Gallery::create([
                'title'    => $request->title,
                'category' => $request->category,
                'image'    => $imagePath,
            ]);

            return back()->with('success', 'Gallery image uploaded successfully!');
        }

        return back()->with('error', 'Please select a valid image file to upload.');
    }

    public function gallerydelete($id)
    {
        if (!Schema::hasTable('galleries')) {
            return back()->with('error', 'Galleries table does not exist.');
        }

        $gallery = Gallery::find($id);
        if ($gallery) {
            $fullPath = public_path($gallery->image);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
            $gallery->delete();
            return back()->with('success', 'Gallery image deleted successfully!');
        }
        return back()->with('error', 'Gallery image not found.');
    }
}
