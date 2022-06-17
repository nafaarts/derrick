@extends('admin._layouts.master')

@section('title', 'Edit Blog')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.js') }}"></script>
@endsection

@section('body')
    <a href="{{ route('blog.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY overflow-hidden shadow-sm sm:rounded-lg text-xs">
        <div class="p-4" x-data="imageViewer()">
            <h2>Edit Blog</h2>
            <hr class="my-3">
            <form method="POST" action="{{ route('blog.update', $blog) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col-reverse md:flex-row">
                    <div class="md:w-3/4 w-full">
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">title <span class="text-red-500">*</span></label></br>
                            <input type="text" class="mt-1 w-full" name="title" id="title" value="{{ $blog->title }}"
                                placeholder="Add blog title">
                            @error('title')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">headline <span
                                    class="text-red-500">*</span></label></br>
                            <input type="text" class="mt-1 w-full" name="headline" id="headline"
                                placeholder="Add blog headline" value="{{ $blog->headline }}">
                            @error('headline')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">content <span
                                    class="text-red-500">*</span></label></br>
                            <div class="mt-2 overflow-hidden">
                                <input id="x" type="hidden" name="content" value="{{ $blog->content }}" />
                                <trix-editor input="x" class="trix-content overflow-y-auto border-0" style="height: 50vh">
                                </trix-editor>
                            </div>
                            @error('content')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="md:w-1/4 w-full p-0 md:p-3">
                        <div class="flex overflow-hidden rounded-md mb-4 mt-2 w-full">
                            <select class="bg-TERTIARY p-2 flex-1" name="status">
                                <option value="published" @selected($blog->status == 'published')>Save and Publish</option>
                                <option value="draft" @selected($blog->status == 'draft')>Save Draft</option>
                            </select>
                            <button type="submit"
                                class="bg-SECONDARY hover:bg-SECONDARY/80 py-2 px-3 rounded-r-md text-white ">Submit</button>
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">author </label></br>
                            <input type="text" class="mt-1 w-full" name="author" id="author"
                                value="{{ $blog->user->name }}" readonly disabled>
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">Image Link </label></br>
                            <input type="text" class="mt-1 w-full" name="image_link" id="image_link" x-model="link"
                                placeholder="Add image URL" x-on:change="imageUrl = link">
                            @error('image_link')
                                <small class="text-red-500">{{ $message }}</small><br>
                            @enderror
                            <small class="text-zinc-400">* leave it empty if you want to upload an image below</small>
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">upload image <span
                                    class="text-red-500">*</span></label>
                            </br>
                            <div class="border rounded-md p-2 mt-1 image-form">
                                <label for="image" class="overflow-hidden rounded-md">
                                    <img :src="imageUrl" class="object-cover rounded w-full">
                                    <input type="file" class="hidden" name="image" id="image" accept="image/*"
                                        @change="fileChosen">
                                </label>
                            </div>
                            @error('image')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/attachments.js') }}"></script>
    <script>
        function imageViewer() {
            return {
                imageUrl: "{{ $blog->image_link ?? asset('blog/' . $blog->image) }}",
                link: "{{ $blog->image_link }}",
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                    this.link = ""
                },
                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>
@endsection
