@extends('_layouts.auth')

@section('title', 'Reset')

@section('body')
    <div>
        <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 mb-5">Reset Password</h2>
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
    @if (session('status'))
        <div class="bg-red-100 border text-xs border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <form method="POST" class="mt-5 space-y-6" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email" autocomplete="email" required autofocus
                class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                placeholder="Email address" value="{{ old('email') }}">
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
                Send Password Reset Link
            </button>
        </div>
    </form>
    <small class="block text-center">Already have an account? <a class="text-orange-500 hover:text-orange-400"
            href="{{ route('login') }}">Login</a></small>
@endsection
