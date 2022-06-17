@extends('admin._layouts.master')

@section('title', 'Dashboard')

@section('head')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection

@section('body')
    <div class="flex justify-between items-center bg-gradient-to-r from-PRIMARY to-PRIMARY/60 rounded-lg py-8 px-10 mb-4">
        <div class="welcome">
            <h1 class="font-light text-gray-500">Welcome </h1>
            <h1 class="md:text-2xl text-base font-bold text-SECONDARY">{{ auth()->user()->name }}</h1>
            <small><a class="text-gray-500 hover:text-SECONDARY" href="{{ route('profile') }}"><i
                        class="fas fa-fw fa-arrow-left"></i> Profile</a></small>
        </div>
        <lottie-player src="{{ asset('dashboard.json') }}" background="transparent" speed="1"
            class="h-20 w-20 md:w-36 md:h-36" loop autoplay></lottie-player>
    </div>

    <div class="bg-PRIMARY rounded-lg py-8 px-10 overflow-hidden">
        <h5 class="text-xs text-gray-500">Registered Competition :</h5>
        <hr class="my-3 border-TERTIARY">
        @if ($registers)
            <div class="relative">
                <div class="relative z-30">
                    <h4 class="font-bold text-gray-700"><a href="{{ route('registrant.competition') }}">International
                            Drilling Fluid Design Competition</a></h4>
                    <span class="text-gray-500 text-xs">Registered {{ $registers->created_at->diffForHumans() }}</span>
                    <table class="text-xs mt-4 text-gray-500">
                        <tr>
                            <td>Team Name</td>
                            <td class="px-2">:</td>
                            <td class="font-bold">{{ $registers->team_name }}</td>
                        </tr>
                        <tr>
                            <td>Leader's Name</td>
                            <td class="px-2">:</td>
                            <td class="font-bold">{{ $registers->user->name }}</td>
                        </tr>
                        <tr>
                            <td>University</td>
                            <td class="px-2">:</td>
                            <td class="font-bold">{{ $registers->university }}</td>
                        </tr>
                        <tr>
                            <td>Member</td>
                            <td class="px-2">:</td>
                            <td class="font-bold">{{ $registers->members->count() }} of
                                {{ $registers->competition->max_member }}</td>
                        </tr>
                    </table>
                </div>
                <img src="{{ asset('storage/competition/logo/' . $registers->competition->logo) }}"
                    class="absolute -top-12 -right-12 w-56 opacity-25 z-0" alt="Competition logo">
            </div>
        @else
            <h4 class="text-gray-500 mb-8">You have not registered yet</h4>
            <a href="{{ route('events') }}" class="py-2 px-4 text-white bg-SECONDARY rounded-md"><i
                    class="fas fa-fw fa-arrow-right"></i> Register
                Now</a>
        @endif
    </div>
@endsection
