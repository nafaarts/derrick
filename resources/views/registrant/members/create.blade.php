@extends('admin._layouts.master')

@section('title', 'Add Member')

@section('body')
    <a href="{{ route('registrant.member.index') }}" class="text-xs text-orange-800 rounded-md">
        <i class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Add Member</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('registrant.member.store') }}" method="POST" x-data="imageViewer()"
            enctype="multipart/form-data">
            @csrf
            <div class="flex md:flex-row flex-col gap-4">
                <div class="w-full md:w-4/5">
                    <div class="mb-4 w-full">
                        <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                        <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Enter full name"
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="text-gray-600 capitalize">major <span class="text-red-500">*</span></label></br>
                        <input type="text" name="major" id="major" class="mt-1 w-full" placeholder="Enter major"
                            value="{{ old('major') }}">
                        @error('major')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex gap-2 mb-4">
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">email <span class="text-red-500">*</span></label></br>
                            <input type="email" name="email" id="email" class="mt-1 w-full" placeholder="Enter email"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">phone <span class="text-red-500">*</span></label></br>
                            <input type="text" name="phone" id="phone" class="mt-1 w-full" placeholder="Enter phone"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-2 mb-4">
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">ID Card <span
                                    class="text-red-500">*</span></label></br>
                            <input type="file" name="id_card" id="id_card" class="mt-1 w-full"
                                value="{{ old('id_card') }}">
                            @error('id_card')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">Student Card <span
                                    class="text-red-500">*</span></label></br>
                            <input type="file" name="student_card" id="student_card" class="mt-1 w-full"
                                value="{{ old('student_card') }}">
                            @error('student_card')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/5">
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
            </div>
            <button type="submit" class="py-2 px-8 rounded-md bg-SECONDARY hover:bg-SECONDARY/80 text-white">Submit changes
            </button>
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
