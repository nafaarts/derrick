@extends('_layouts.main')

@section('title', $event->name)

@section('body')
    <div class="main-event" style="background-image: url('{{ asset('storage/events/photo/' . $event->photo) }}')">
        <div class="py-10 md:py-20 bg-gradient-to-r from-BACKGROUND to-transparent w-full">
            <div class="derrick-container flex md:flex-row flex-col-reverse">
                <div class="w-full md:w-1/2 p-5 text-center md:text-left flex items-center">
                    <div class="space-y-10 w-full">
                        <h2 class="font-extrabold text-5xl text-PRIMARY">
                            {{ $event->name }}
                        </h2>
                        {{-- <h2
                            class="font-extrabold text-transparent text-5xl bg-clip-text bg-gradient-to-r from-orange-500 to-HEADINGTEXT">
                            {{ $event->name }}</h2> --}}

                        {{-- <div class="text-white flex items-center space-x-3 md:mx-0 mx-auto w-fit">
                            <span class="flex h-3 w-3">
                                <span
                                    class="{{ $event->getStatus('color') }} animate-pulse relative inline-flex rounded-full h-3 w-3"></span>
                            </span>
                            <span>{{ $event->getStatus() }}</span>
                        </div> --}}

                        <div class="flex md:mx-0 mx-auto w-fit gap-10">
                            <div class="text-white">
                                <small>Category :</small>
                                <p class="font-light">{{ $event->category }} EVENT</p>
                            </div>
                            {{-- <div class="text-white">
                                <small>Views :</small>
                                <p class="font-light">{{ $event->views }} <i class="fas fa-fw fa-eye"></i></p>
                            </div> --}}
                        </div>

                        <div class="flex md:mx-0 mx-auto w-fit">
                            <div class="text-white">
                                <small>Event date : </small>
                                <p class="font-light">{{ defaultDateFrom($event->start_date, $event->end_date) }}</p>
                            </div>
                        </div>

                        @if ($event->registration_required)
                            <div class="flex space-x-3 md:mx-0 mx-auto w-fit">
                                <a href="{{ route('event.register', $event) }}"
                                    class="py-2 px-6 rounded-md bg-SECONDARY hover:bg-SECONDARY/75 text-white"><i
                                        class="fas fa-fw fa-hand-pointer rotate-45 mr-1"></i> Register
                                    Event</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex items-center justify-center">
                    <img src="{{ asset('storage/events/logo/' . $event->logo) }}" alt="Event Logo" width="250">
                </div>
            </div>
            <div class="p-10 mt-10 derrick-container">
                <hr class="border-white/50">
                <p class="text-white mt-10 text-center md:text-left">{{ $event->description }}</p>
            </div>
        </div>
    </div>

@endsection
