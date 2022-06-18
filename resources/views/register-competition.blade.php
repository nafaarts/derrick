@extends('_layouts.main')

@section('title', 'Registration | ' . $competition->name)

@section('body')
    @include('components.label', ['label' => 'Competition Registration'])

    <div class="derrick-container flex flex-col md:flex-row gap-5 p-5">
        <div class="w-full md:w-2/3 p-3">
            <h5 class="text-base mb-2 font-light tracking-wide">{{ $competition->name }}</h5>
            <h2 class="text-3xl font-bold text-SECONDARY tracking-wide">Competition Registration</h2>
            <hr class="
                border-TERTIARY my-5">
            <form action="{{ route('competition.register', $competition) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Team Name <span class="text-red-500">*</span></label></br>
                    <input required type="text" name="team_name" id="team_name" class="mt-1 w-full"
                        placeholder="Enter your team name" value="{{ old('team_name') }}">
                    @error('team_name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex gap-2 mb-4">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Leader's Name <span
                                class="text-red-500">*</span></label></br>
                        <input required type="text" id="leadersname" readonly class="mt-1 w-full"
                            value="{{ auth()->user()->name }}">
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Leader's Email <span
                                class="text-red-500">*</span></label></br>
                        <input required type="text" name="email" id="email" readonly class="mt-1 w-full"
                            value="{{ auth()->user()->email }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-gray-600 capitalize">University <span class="text-red-500">*</span></label></br>
                    <input required type="text" name="university" id="university" class="mt-1 w-full"
                        placeholder="Enter your university" value="{{ old('university') }}">
                    @error('university')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex gap-2 mb-4">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Leader's Major <span
                                class="text-red-500">*</span></label></br>
                        <input required type="text" name="major" id="major" class="mt-1 w-full"
                            placeholder="Enter your major" value="{{ old('major') }}">
                        @error('major')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Leader's Phone Number <span
                                class="text-red-500">*</span></label></br>
                        <input required type="text" name="phone" id="phone" class="mt-1 w-full"
                            placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-2 mb-4">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">leader's ID Card <span
                                class="text-red-500">*</span></label></br>
                        <input required type="file" name="id_card" id="id_card" class="mt-1 w-full"
                            placeholder="Enter your id_card" value="{{ old('id_card') }}">
                        @error('id_card')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">leader's Student Card <span
                                class="text-red-500">*</span></label></br>
                        <input required type="file" name="student_card" id="student_card" class="mt-1 w-full"
                            placeholder="Enter your student_card" value="{{ old('student_card') }}">
                        @error('student_card')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <p class="text-DARKER">* Don't forget to submit your another member's data.</p>
                <hr class="
                border-TERTIARY my-5">
                <div class="flex justify-between items-center">
                    <button type="reset" class="py-2 px-4 text-SECONDARY font-bold"><i class="fas fa-fw fa-refresh"></i>
                        Clear form</button>
                    <button type="submit" class="py-2 px-4 bg-SECONDARY rounded-md text-white"><i
                            class="fas fa-fw fa-arrow-right"></i>
                        Checkout Competition</button>
                </div>
            </form>
        </div>
        <div class="w-full md:w-1/3 p-3">
            <div class="w-full border border-TERTIARY rounded-md text-center p-10 bg-white/50">
                <img src="{{ asset('storage/competition/logo/' . $competition->logo) }}" class="mx-auto"
                    alt="competition Logo" width="100">
                <strong class="block mt-5 text-HEADINGTEXT font-bold text-xl">{{ $competition->name }}</strong><br>
                <small
                    class="font-light">{{ defaultDateFrom($competition->start_date, $competition->end_date) }}</small>
            </div>
            <hr class="border-TERTIARY my-5">
            <strong class="block text-HEADINGTEXT font-bold text-2xl">{{ $competition->name }}</strong>
            <p class="font-light mt-3">{{ $competition->description }}</p>
        </div>
    </div>
@endsection
