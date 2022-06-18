@extends('_layouts.main')

@section('title', 'Registration | ' . $event->name)

@section('body')
    @include('components.label', ['label' => 'Event Registration'])

    <div class="derrick-container flex flex-col md:flex-row gap-5 p-5">
        <div class="w-full md:w-2/3 p-3">
            <h5 class="text-base mb-2 font-light tracking-wide">{{ $event->name }}</h5>
            <h2 class="text-3xl font-bold text-SECONDARY tracking-wide">Event Registration</h2>
            <hr class="
                border-TERTIARY my-5">
            <form action="{{ route('event.register', $event) }}" method="post">
                @csrf
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                    <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Enter your name"
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Email <span class="text-red-500">*</span></label></br>
                    <input type="text" name="email" id="email" class="mt-1 w-full" placeholder="Enter your email"
                        value="{{ old('email') }}">
                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Current Status <span class="text-red-500">*</span></label></br>
                    <select name="education_level" id="education_level" class="mt-1 w-full pl-3">
                        <option value="" selected>Select your current status</option>
                        @foreach (['S1', 'S2', 'S3', 'D3/D4', 'Others'] as $status)
                            <option @selected(old('education_level') == $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('education_level')
                        <small class=" text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Level of education <span
                            class="text-red-500">*</span></label></br>
                    <select name="current_status" id="current_status" class="mt-1 w-full pl-3">
                        <option value="" selected>Select your education level</option>
                        @foreach (['Active student', 'Fresh graduate', 'Young Professional (1-3 years work experience)', 'Practitioner with more than 3 years of work experience'] as $status)
                            <option @selected(old('current_status') == $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('current_status')
                        <small class=" text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">City of Resident <span
                            class="text-red-500">*</span></label></br>
                    <input type="text" name="resident" id="resident" class="mt-1 w-full"
                        placeholder="Enter your city of resident" value="{{ old('resident') }}">
                    @error('resident')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Institution / University</label></br>
                    <input type="text" name="institution" id="institution" class="mt-1 w-full"
                        placeholder="Enter your institution" value="{{ old('institution') }}">
                    @error('institution')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Major</br>
                        <input type="text" name="major" id="major" class="mt-1 w-full"
                            placeholder="Enter your major" value="{{ old('major') }}">
                        @error('major')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Phone Number <span class="text-red-500">*</span></label></br>
                    <input type="text" name="phone" id="phone" class="mt-1 w-full" placeholder="Enter your phone"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Please write down any question regarding our upcoming event
                        <span class="text-red-500">*</span></label></br>
                    <textarea rows="10" name="remark" id="remark" class="mt-1 w-full" placeholder="Enter your remark">{{ old('remark') }}</textarea>
                    @error('remark')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex justify-between items-center">
                    <button type="reset" class="py-2 px-4 text-SECONDARY font-bold"><i class="fas fa-fw fa-refresh"></i>
                        Clear form</button>
                    <button type="submit" class="py-2 px-4 bg-SECONDARY rounded-md text-white"><i
                            class="fas fa-fw fa-arrow-right"></i>
                        Register Event</button>
                </div>
            </form>
        </div>
        <div class="w-full md:w-1/3 p-3">
            <div class="w-full border border-TERTIARY rounded-md text-center p-10 bg-white/50">
                <img src="{{ asset('storage/events/logo/' . $event->logo) }}" class="mx-auto" alt="Event Logo"
                    width="100">
                <strong class="block mt-5 text-HEADINGTEXT font-bold text-xl">{{ $event->name }}</strong><br>
                <small class="font-light">{{ defaultDateFrom($event->start_date, $event->end_date) }}</small>
            </div>
            <hr class="border-TERTIARY my-5">
            <strong class="block text-HEADINGTEXT font-bold text-2xl">{{ $event->name }}</strong>
            <p class="font-light mt-3">{{ $event->description }}</p>
        </div>
    </div>

@endsection
