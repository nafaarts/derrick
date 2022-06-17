<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');

        return view('admin.blog.index', [
            'blogs' => Blog::where('user_id', auth()->id())->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');

        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $this->validate(request(), [
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'image' => Rule::requiredIf(request('image_link') == null),
            'image_link' => 'url',
            'image_link' => Rule::requiredIf(request('image') == null),
            'status' => 'required|in:draft,published',
        ]);

        if (request()->has('image') && request('image_link') == null) {
            $request->image->store('public/blog');
            $name = $request->image->hashName();
        }

        Blog::create([
            'title' => request('title'),
            'slug' => str()->slug(request('title')),
            'headline' => request('headline'),
            'content' => request('content'),
            'image' => $name ?? null,
            'image_link' => request()->has('image') && !request()->has('image_link') ? null : request('image_link'),
            'status' => request('status'),
            'user_id' => auth()->id(),
            'views' => 0,
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog Created successfully');
    }

    public function uploadImageFromEditor(Request $request)
    {
        $this->authorize('isAdmin');

        if ($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            //Upload File
            $request->file('file')->storeAs('public/uploads', $filenametostore);
            // you can save image path below in database
            $path = asset('storage/uploads/' . $filenametostore);
            echo $path;
            exit;
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $this->authorize('isAdmin');

        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('isAdmin');

        $this->validate(request(), [
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'image' => Rule::requiredIf(request('image_link') == null && $blog->image == null),
            'image_link' => 'url',
            'image_link' => Rule::requiredIf(request('image') == null && $blog->image == null),
            'status' => 'required|in:draft,published',
        ]);

        if (request()->has('image')) {
            File::delete(public_path('storage/blog/' . $blog->image));
            $request->image->store('public/blog');
            $name = $request->image->hashName();
        } else {
            $name = $blog->image;
        }

        if (request('image_link') != null) {
            File::delete(public_path('storage/blog/' . $blog->image));
            $name = null;
        }

        $blog->update([
            'title' => request('title'),
            'slug' => str()->slug(request('title')),
            'headline' => request('headline'),
            'content' => request('content'),
            'image' => $name ?? null,
            'image_link' => request('image_link'),
            'status' => request('status'),
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('isAdmin');

        if ($blog->image != null) {
            File::delete(public_path('/blog/' . $blog->image));
        }
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Blog Deleted successfully');
    }
}
