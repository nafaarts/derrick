@extends('admin._layouts.master')

@section('title', 'Dashboard')


@section('head')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection

@section('body')
    <div class="flex flex-wrap md:flex-nowrap gap-4 mb-4 text-center md:text-right text-white">
        <div class="w-full md:w-1/4 bg-SECONDARY rounded-md p-5">
            <small class="font-light">Competition</small>
            <h2 class="text-2xl text-PRIMARY font-bold">{{ $competition }}</h2>
        </div>
        <div class="w-full md:w-1/4 bg-SECONDARY/90 rounded-md p-5">
            <small class="font-light">Event</small>
            <h2 class="text-2xl text-PRIMARY font-bold">{{ $event }}</h2>
        </div>
        <div class="w-full md:w-1/4 bg-SECONDARY/80 rounded-md p-5">
            <small class="font-light">Competition Registrant</small>
            <h2 class="text-2xl text-PRIMARY font-bold">{{ $competition_registrant->count() }}</h2>
        </div>
        <div class="w-full md:w-1/4 bg-SECONDARY/70 rounded-md p-5">
            <small class="font-light">Event Registrant</small>
            <h2 class="text-2xl text-PRIMARY font-bold">{{ $event_registrant->count() }}</h2>
        </div>
    </div>

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

    <div class="flex md:flex-row flex-col gap-4">
        <div class="w-full md:w-1/2 rounded-md bg-PRIMARY p-5">
            <small class="text-gray-400 font-light">Latest registrant of events</small>
            <table class="text-left w-full text-xs text-gray-500 mt-4 rounded-md overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-2 px-2 bg-TERTIARY">
                            Name
                        </th>
                        <th class="py-2 px-2 bg-TERTIARY">
                            Event
                        </th>
                        <th class="py-2 px-2 bg-TERTIARY">
                            Timestamp
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event_registrant->slice(0, 5) as $item)
                        <tr>
                            <td class="py-2 px-2 border-b border-TERTIARY">
                                <p>{{ $item->name }}</p>
                                <small>{{ $item->email }}</small>
                            </td>
                            <td class="py-2 px-2 border-b border-TERTIARY">{{ $item->event->name }}</td>
                            <td class="py-2 px-2 border-b border-TERTIARY">{{ $item->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="w-full md:w-1/2 rounded-md bg-PRIMARY p-5">
            <small class="text-gray-400 font-light">Latest registrant of competitions</small>
            <table class="text-left w-full text-xs text-gray-500 mt-4 rounded-md overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-2 px-2 bg-TERTIARY">
                            Team
                        </th>
                        <th class="py-2 px-2 bg-TERTIARY">
                            Competition
                        </th>
                        <th class="py-2 px-2 bg-TERTIARY">
                            Timestamp
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($competition_registrant->slice(0, 5) as $item)
                        <tr>
                            <td class="py-2 px-2 border-b border-TERTIARY">
                                <a href="{{ route('search') . '?q=' . $item->registration_number }}">
                                    <p class="block mb-1">{{ $item->team_name }}</p>
                                </a>
                                <small>{{ $item->user->name }}</small>
                            </td>
                            <td class="py-2 px-2 border-b border-TERTIARY">
                                <p class="block mb-1">
                                    {{ $item->competition->name }}
                                </p>
                                @if ($item->isPaid())
                                    <span class="text-green-500 rounded-md">
                                        <i class="fas fa-fw fa-check"></i>
                                        {{ $item->latestPayment()->transaction_status ?? '' }}
                                    </span>
                                @else
                                    <span class="text-yellow-500 rounded-md">
                                        <i class="fas fa-fw fa-hourglass"></i>
                                        {{ $item->latestPayment()->transaction_status ?? '' }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-2 px-2 border-b border-TERTIARY">{{ $item->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
