@extends('_layouts.auth')

@section('title', 'Login')

@section('body')
    <div>
        <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 mb-5">Sign in to your account</h2>
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
    <form class="mt-5 space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="rounded-md -space-y-px">
            <div class="mb-2">
                <label for="email-address" class="sr-only">Email address</label>
                <input id="email-address" name="email" type="email" autocomplete="email" required autofocus
                    class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                    placeholder="Email address" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="appearance-none w-full border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm"
                    placeholder="Password">
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" value="true"
                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900"> Remember me </label>
            </div>
            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-orange-600 hover:text-orange-500">
                        Forgot your password?
                    </a>
                </div>
            @endif
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
                Sign in
            </button>
        </div>
    </form>
    <small class="block text-center">don't have an account? <a class="text-orange-500 hover:text-orange-400"
            href="{{ route('register') }}">Sign Up</a></small>
@endsection
