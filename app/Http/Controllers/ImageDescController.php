<?php
//app/Http/Controllers/ImageDescController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageDescController extends Controller
{
    public function index()
    {
        $description = auth("web")->user()->description;
        $images = Image::all();
    
        return view('admin.images.index', compact('description', 'images'));
    }
    

    public function updateDescription(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        User::where('id', auth("web")->user()->id)->update([
            "description"=> $request->description
        ]);

        return redirect()->back()->with('success', 'Description updated successfully!');
    }

    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);
    
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);
    
        // Simpan ke DB
        Image::create([
            'image' => $imageName,
            'profile_photo' => 'default.jpg'
        ]);
    
        return redirect()->back()->with('success', 'Image added successfully!');
    }
    
    public function destroy($id)
{
    $image = Image::findOrFail($id);
    $imagePath = public_path('img/' . $image->image);

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $image->delete();

    return redirect()->back()->with('success', 'Image deleted successfully!');
}

    
}
