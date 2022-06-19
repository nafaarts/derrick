@extends('admin._layouts.master')

@section('title', 'Edit Gallery')

@section('body')
    <a href="{{ route('gallery.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <form action="{{ route('gallery.update', $gallery) }}" class="container mx-auto p-4 bg-PRIMARY rounded-md text-xs"
        method="POST" enctype="multipart/form-data">
        <h2>Edit Gallery</h2>
        <hr class="my-3 border-TERTIARY">
        <div class="flex flex-col md:flex-row" x-data="imageViewer()">
            <label for="image" class="w-full md:flex-1 mr-3 overflow-hidden rounded-md p-2">
                <img :src="imageUrl" class="object-cover rounded w-full">
                <input type="file" class="hidden" name="image" id="image" accept="image/*" @change="fileChosen">
            </label>
            <div class="form w-full md:flex-1">
                @csrf
                @method('PUT')
                <div class="flex flex-col mb-2">
                    <label for="alt">Alt</label>
                    <input type="text" name="alt" id="alt" class="mt-1 w-full" value="{{ $gallery->alt }}">
                    @error('alt')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex flex-col mb-2">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="mt-1 w-full" x-model="link"
                        x-on:change="imageUrl = link">
                    @error('link')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex flex-col mb-2">
                    <label for="description">Caption (optional)</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="mt-1 w-full">{{ $gallery->description }}</textarea>
                    @error('description')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <button type="submit"
                        class="py-2 px-4 bg-SECONDARY hover:bg-SECONDARY/80 rounded-md text-white">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function imageViewer() {
            return {
                imageUrl: "{{ $gallery->link ?? asset('storage/gallery/' . $gallery->image) }}",
                link: "{{ $gallery->link }}",
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                    this.link = ''
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
