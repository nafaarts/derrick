@extends('_layouts.auth')

@section('title', 'Register')

@section('body')
    <div>
        <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 mb-5">Register Account</h2>
        <hr>
    </div>
    @if ($errors->any())
        <div class="bg-red-100 border text-xs border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="mt-5 space-y-6" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="rounded-md shadow-sm">
            <div class="mb-2">
                <label for="name" class="sr-only">Name</label>
                <input id="name" name="name" type="name" autocomplete="name"
                    class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                    placeholder="Name" value="{{ old('name') }}">
            </div>
            <div class="mb-2">
                <label for="email" class="sr-only">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email"
                    class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                    placeholder="Email Address" value="{{ old('email') }}">
            </div>
            <div class="mb-2">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password"
                    class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                    placeholder="Password">
            </div>
            <div>
                <label for="password_confirmation" class="sr-only">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                    placeholder="Confirm Password">
            </div>
        </div>

        <div>
            <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-orange-500 group-hover:text-orange-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                Register
            </button>
        </div>
    </form>
    <small class="block text-center">Already have an account? <a class="text-orange-500 hover:text-orange-400"
            href="{{ route('login') }}">Login</a></small>
@endsection
