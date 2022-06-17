@extends('admin._layouts.master')

@section('title', 'Add Committee')

@section('body')
    <a href="{{ route('committee.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Add Committee</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('committee.store') }}" method="POST" enctype="multipart/form-data" x-data="imageViewer()">
            @csrf
            <div class="flex gap-2">
                <div class="mb-4 md:w-3/4 w-full">
                    <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                    <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Enter full name"
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4 mt-5 md:w-1/4 w-full">
                    <div class="flex">
                        <div class="flex-1">
                            <select name="status" id="status" class="bg-TERTIARY rounded-l-md p-2 w-full">
                                <option value="1" @selected(old('status') == '1')>Save and Publish</option>
                                <option value="0" @selected(old('status') == '1')>Save Draft</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="py-2 px-4 rounded-r-md bg-SECONDARY hover:bg-SECONDARY/80 text-white">Submit</button>
                    </div>
                    @error('status')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="text-gray-600 capitalize">title <span class="text-red-500">*</span></label></br>
                <input type="text" name="title" id="title" class="mt-1 w-full" placeholder="Enter title"
                    value="{{ old('title') }}">
                @error('title')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-80">
                <label class="text-gray-600 capitalize">upload photo <span class="text-red-500">*</span></label>
                </br>
                <div class="mt-1 image-form">
                    <label for="photo" class="overflow-hidden rounded-md">
                        <img :src="imageUrl" class="object-cover rounded w-full">
                        <input type="file" class="hidden" name="photo" id="photo" accept="image/*"
                            @change="fileChosen">
                    </label>
                </div>
                @error('photo')
                    <small class="text-red-500">{{ $message }}</small><br>
                @enderror
                <small>* click image to change</small>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function imageViewer() {
            return {
                imageUrl: "{{ asset('img/default.png') }}",
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
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
