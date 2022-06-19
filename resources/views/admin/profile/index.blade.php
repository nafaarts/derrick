@extends('admin._layouts.master')

@section('title', 'Profile')

@section('body')
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>My Profile</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('profile') }}" method="POST" x-data="imageViewer()" enctype="multipart/form-data">
            <div class="flex md:flex-row flex-col gap-4">
                @csrf
                @method('PUT')
                <div class="w-full md:w-4/5">
                    <div class="mb-4 w-full">
                        <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                        <input type="text" name="name" id="name" class="mt-1 w-full"
                            placeholder="Enter full name" value="{{ old('name') ?? $profile->name }}">
                        @error('name')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="text-gray-600 capitalize">email <span class="text-red-500">*</span></label></br>
                        <input type="email" name="email" id="email" class="mt-1 w-full" placeholder="Enter email"
                            readonly value="{{ old('email') ?? $profile->email }}">
                        @error('email')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="flex md:flex-row flex-col gap-2">
                            <div class="w-full md:w-1/2">
                                <label class="text-gray-600 capitalize">Change Password</label></br>
                                <input type="password" name="password" id="password" class="mt-1 w-full"
                                    placeholder="Enter password" value="{{ old('password') }}">
                                @error('password')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="text-gray-600 capitalize">Confirm Password</label></br>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="mt-1 w-full" placeholder="Enter password confirmation"
                                    value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @can('isRegistrantRegistered')
                        <div class="mb-4">
                            <label class="text-gray-600 capitalize">University <span class="text-red-500">*</span></label></br>
                            <input type="text" name="university" id="university" class="mt-1 w-full"
                                placeholder="Enter your university"
                                value="{{ old('university') ?? $profile->registrant->university }}">
                            @error('university')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="flex md:flex-row flex-col gap-2 mb-4">
                            <div class="w-full md:w-1/2">
                                <label class="text-gray-600 capitalize">Major <span class="text-red-500">*</span></label></br>
                                <input type="text" name="major" id="major" class="mt-1 w-full"
                                    placeholder="Enter your major" value="{{ old('major') ?? $profile->registrant->major }}">
                                @error('major')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="text-gray-600 capitalize">Phone Number <span
                                        class="text-red-500">*</span></label></br>
                                <input type="text" name="phone" id="phone" class="mt-1 w-full"
                                    placeholder="Enter your phone number"
                                    value="{{ old('phone') ?? $profile->registrant->phone_number }}">
                                @error('phone')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="flex md:flex-row flex-col gap-2 mb-4">
                            <div class="w-full md:w-1/2">
                                <label class="text-gray-600 capitalize">ID Card <span class="text-red-500">*</span></label></br>
                                <input type="file" name="id_card" id="id_card" class="mt-1 w-full"
                                    placeholder="Enter your id_card" value="{{ old('id_card') }}">
                                @error('id_card')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                                <small>
                                    <a target="_blank" class="hover:text-orange-400 text-orange-500 ml-2"
                                        href="{{ asset('storage/competition/registrant/id_card/' . $profile->registrant->id_card) }}"><i
                                            class="fas fa-fw fa-id-card"></i> {{ $profile->registrant->id_card }}</a>
                                </small>
                            </div>

                            <div class="w-full md:w-1/2">
                                <label class="text-gray-600 capitalize">Student Card <span
                                        class="text-red-500">*</span></label></br>
                                <input type="file" name="student_card" id="student_card" class="mt-1 w-full"
                                    placeholder="Enter your student_card" value="{{ old('student_card') }}">
                                @error('student_card')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                                <small>
                                    <a target="_blank" class="hover:text-orange-400 text-orange-500 ml-2"
                                        href="{{ asset('storage/competition/registrant/student_card/' . $profile->registrant->student_card) }}"><i
                                            class="fas fa-fw fa-id-card"></i> {{ $profile->registrant->student_card }}</a>
                                </small>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="w-full md:w-1/5 mb-5">
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
            <button type="submit" class="py-2 px-8 rounded-md bg-SECONDARY hover:bg-SECONDARY/80 text-white">Submit
                changes
            </button>
        </form>
    </div>
@endsection
{{-- isRegistrantRegistered --}}
@section('scripts')
    <script>
        function imageViewer() {
            return {
                imageUrl: "{{ asset($profile->profile_image ? 'storage/profile/' . $profile->profile_image : 'img/sample.png') }}",
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
