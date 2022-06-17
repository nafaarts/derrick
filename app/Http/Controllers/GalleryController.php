<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin');

        $galleries = Gallery::where('user_id', auth()->id())->latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        $this->authorize('isAdmin');

        return view('admin.gallery.create');
    }

    public function store()
    {
        $this->authorize('isAdmin');

        $this->validate(request(), [
            'image' => 'image|mimes:jpeg,png,jpg',
            'image' => Rule::requiredIf(request('link') == null),
            'alt' => 'required|string|max:255',
            'link' => 'url',
            'link' => Rule::requiredIf(request('image') == null),
        ]);

        if (request()->has('image') && request('link') == null) {
            request('image')->store('public/gallery');
            $name = request('image')->hashName();
        }

        Gallery::create([
            'image' => $name ?? null,
            'description' => request('description'),
            'alt' => request('alt'),
            'link' => request()->has('image') && !request()->has('link') ? null : request('link'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('gallery.index')->with('success', 'Image Uploaded successfully');
    }

    public function edit(Gallery $gallery)
    {
        $this->authorize('isAdmin');

        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Gallery $gallery)
    {
        $this->authorize('isAdmin');

        $this->validate(request(), [
            'image' => 'image|mimes:jpeg,png,jpg',
            'image' => Rule::requiredIf(request('link') == null && $gallery->image == null),
            'alt' => 'required|string|max:255',
            'link' => 'url',
            'link' => Rule::requiredIf(request('image') == null && $gallery->image == null),
        ]);

        if (request()->has('image')) {
            File::delete(public_path('storage/gallery/' . $gallery->image));
            request('image')->store('public/gallery');
            $name = request('image')->hashName();
        } else {
            $name = $gallery->image;
        }

        if (request('link') != null) {
            File::delete(public_path('storage/gallery/' . $gallery->image));
            $name = null;
        }

        $gallery->update([
            'image' => $name,
            'description' => request('description'),
            'alt' => request('alt'),
            'link' => $name ? null : request('link'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('gallery.index')->with('success', 'Image Updated successfully');
    }

    public function destroy(Gallery $gallery)
    {
        $this->authorize('isAdmin');

        if ($gallery->image != null) {
            File::delete(public_path('storage/gallery/' . $gallery->image));
        }
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Image Deleted successfully');
    }
}
