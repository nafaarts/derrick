@extends('_layouts.auth')

@section('title', 'Verify')

@section('body')
    <div>
        <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 mb-2">Verify your account</h2>
        <hr>
    </div>

    @if (session('resent'))
        <div class="bg-red-100 border text-xs border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <div class="text-center">
        <p>Before proceeding</p>
        <p>Please <strong>check your email</strong> for a verification link.</p>
        <small>also try to check your spam or junk email folder</small>
    </div>
    <form class="d-inline mt-3" method="POST" action="{{ route('verification.resend') }}">
        @csrf
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
                Resend Verification
            </button>
        </div>
    </form>
@endsection
