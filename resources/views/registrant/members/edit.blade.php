@extends('admin._layouts.master')

@section('title', 'Edit Member')

@section('body')
    <a href="{{ route('registrant.member.index') }}" class="text-xs text-orange-800 rounded-md">
        <i class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Edit Member</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('registrant.member.update', $member->id) }}" method="POST" x-data="imageViewer()"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex md:flex-row flex-col gap-4">

                <div class="w-full md:w-4/5">
                    <div class="mb-4 w-full">
                        <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                        <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Enter full name"
                            value="{{ old('name') ?? $member->name }}">
                        @error('name')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="text-gray-600 capitalize">major <span class="text-red-500">*</span></label></br>
                        <input type="text" name="major" id="major" class="mt-1 w-full" placeholder="Enter major"
                            value="{{ old('major') ?? $member->major }}">
                        @error('major')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex gap-2 mb-4">
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">email <span class="text-red-500">*</span></label></br>
                            <input type="email" name="email" id="email" class="mt-1 w-full" placeholder="Enter email"
                                value="{{ old('email') ?? $member->email }}">
                            @error('email')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">phone <span class="text-red-500">*</span></label></br>
                            <input type="text" name="phone" id="phone" class="mt-1 w-full" placeholder="Enter phone"
                                value="{{ old('phone') ?? $member->phone_number }}">
                            @error('phone')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-2 mb-4">
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">ID Card <span
                                    class="text-red-500">*</span></label></br>
                            <input type="file" name="id_card" id="id_card" class="mt-1 w-full mb-2"
                                value="{{ old('id_card') }}">
                            @error('id_card')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <small>
                                <a target="_blank" class="hover:text-orange-400 text-orange-500 ml-2"
                                    href="{{ asset('storage/competition/registrant/id_card/' . $member->id_card) }}"><i
                                        class="fas fa-fw fa-id-card"></i> {{ $member->id_card }}</a>
                            </small>
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">Student Card <span
                                    class="text-red-500">*</span></label></br>
                            <input type="file" name="student_card" id="student_card" class="mt-1 w-full mb-2"
                                value="{{ old('student_card') }}">
                            @error('student_card')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <small>
                                <a target="_blank" class="hover:text-orange-400 text-orange-500 ml-2"
                                    href="{{ asset('storage/competition/registrant/student_card/' . $member->student_card) }}"><i
                                        class="fas fa-fw fa-id-card"></i> {{ $member->student_card }}</a>
                            </small>
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
                imageUrl: "{{ asset('storage/competition/registrant/photo/' . $member->photo) }}",
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
