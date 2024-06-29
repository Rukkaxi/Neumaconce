<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('gallery.index', compact('photos'));
    }

    public function dashboardIndex()
    {
        $photos = Photo::all();
        return view('dashboard.gallery.index', compact('photos'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('photo')) {
            $path = $request->file('photo')->store('photos', 'public');

            Photo::create([
                'title' => $request->title,
                'description' => $request->description,
                'path' => $path,
            ]);
        }

        return redirect()->route('gallery.index')->with('status', 'Imagen subida exitosamente.');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();
        return redirect()->route('gallery.index')->with('status', 'Imagen eliminada exitosamente.');
    }

}

