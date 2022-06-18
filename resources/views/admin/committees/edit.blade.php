@extends('admin._layouts.master')

@section('title', 'Edit Committee')

@section('body')
    <a href="{{ route('committee.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Edit Committee</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('committee.update', $committee) }}" method="POST" enctype="multipart/form-data"
            x-data="imageViewer()">
            @csrf
            @method('PUT')
            <div class="flex gap-2">
                <div class="mb-4 md:w-3/4 w-full">
                    <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                    <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Enter full name"
                        value="{{ $committee->name }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4 mt-5 md:w-1/4 w-full">
                    <div class="flex">
                        <div class="flex-1">
                            <select name="status" id="status" class="bg-TERTIARY rounded-l-md p-2 w-full">
                                <option value="1" @selected($committee->status == '1')>Save and Publish</option>
                                <option value="0" @selected($committee->status == '0')>Save Draft</option>
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
                    value="{{ $committee->title }}">
                @error('title')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex gap-2 mb-4">
                <div class="w-full md:w-1/2">
                    <label class="text-gray-600 capitalize">email <span class="text-red-500">*</span></label></br>
                    <input type="email" name="email" id="email" class="mt-1 w-full"
                        placeholder="Enter Email Address" value="{{ $committee->email }}">
                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-full md:w-1/2">
                    <label class="text-gray-600 capitalize">Phone Number (Whatsapp) <span
                            class="text-red-500">*</span></label></br>
                    <input type="text" name="phone" id="phone_number" class="mt-1 w-full"
                        placeholder="Enter Phone Number" value="{{ $committee->phone }}">
                    @error('phone')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="flex gap-2 mb-4">
                <div class="w-full md:w-1/2">
                    <label class="text-gray-600 capitalize">Instagram link <span class="text-red-500">*</span></label></br>
                    <input type="text" name="instagram" id="instagram" class="mt-1 w-full"
                        placeholder="Enter instagram link" value="{{ $committee->instagram }}">
                    @error('instagram')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-full md:w-1/2">
                    <label class="text-gray-600 capitalize">linkedin link <span class="text-red-500">*</span></label></br>
                    <input type="text" name="linkedin" id="linkedin" class="mt-1 w-full"
                        placeholder="Enter LinkedIn link" value="{{ $committee->linkedin }}">
                    @error('linkedin')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
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
                imageUrl: "{{ asset('storage/committees/' . $committee->photo) }}",
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
