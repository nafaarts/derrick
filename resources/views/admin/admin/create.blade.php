@extends('admin._layouts.master')

@section('title', 'Add Admin')

@section('body')
    <a href="{{ route('admin-management.index') }}" class="text-xs text-orange-800 rounded-md">
        <i class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Add Admin</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('admin-management.store') }}" method="POST">
            @csrf
            <div class="flex gap-2">
                <div class="mb-4 md:w-5/6 w-full">
                    <label class="text-gray-600 capitalize">Name <span class="text-red-500">*</span></label></br>
                    <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Enter full name"
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4 mt-5 md:w-1/6 w-full">
                    <button type="submit"
                        class="py-2 px-4 rounded-md bg-SECONDARY hover:bg-SECONDARY/80 text-white w-full">Submit</button>
                    @error('status')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="text-gray-600 capitalize">email <span class="text-red-500">*</span></label></br>
                <input type="email" name="email" id="email" class="mt-1 w-full" placeholder="Enter email"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">password <span class="text-red-500">*</span></label></br>
                        <input type="password" name="password" id="password" class="mt-1 w-full"
                            placeholder="Enter password" value="{{ old('password') }}">
                        @error('password')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Confirm Password <span
                                class="text-red-500">*</span></label></br>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 w-full" placeholder="Enter password confirmation"
                            value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
