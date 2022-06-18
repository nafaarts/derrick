@extends('_layouts.main')

@section('title', 'Events')

@section('body')

    @include('components.label', ['label' => 'Events & Competitions'])


    <section id="competition" class="derrick-container py-10">
        <h2 class="main-heading-2"><span>Competition</span></h2>
        <div class="flex flex-col md:flex-row flex-wrap mx-auto">
            @foreach ($competitions as $competition)
                <a href="{{ route('competition.detail', $competition) }}" data-aos="fadein"
                    data-aos-delay="{{ $loop->iteration * 100 }}" class="w-full md:w-1/4 p-2">
                    <div class="event-wrapper"
                        style="background-image: url('{{ asset('storage/competition/photo/' . $competition->photo) }}')">
                        <div class="event-content">
                            <img src="{{ asset('storage/competition/logo/' . $competition->logo) }}" class="mx-auto"
                                alt="competition Logo" width="100">
                            <strong class="block mt-5 text-HEADINGTEXT font-bold">{{ $competition->name }}</strong><br>
                            <small
                                class="font-light">{{ defaultDateFrom($competition->start_date, $competition->end_date) }}</small>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Pre Event --}}
    <section class="derrick-container py-10">
        <h2 class="main-heading-2"><span>Pre Event</span></h2>
        <div class="flex flex-col md:flex-row flex-wrap mx-auto">
            @foreach ($preEvent as $event)
                <a href="{{ route('event.detail', $event) }}" data-aos="fadein"
                    data-aos-delay="{{ $loop->iteration * 100 }}" class="w-full md:w-1/4 p-2">
                    <div class="event-wrapper"
                        style="background-image: url('{{ asset('storage/events/photo/' . $event->photo) }}')">
                        <div class="event-content">
                            <img src="{{ asset('storage/events/logo/' . $event->logo) }}" class="mx-auto" alt="Event Logo"
                                width="100">
                            <strong class="block mt-5 text-HEADINGTEXT font-bold">{{ $event->name }}</strong><br>
                            <small class="font-light">{{ defaultDateFrom($event->start_date, $event->end_date) }}</small>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Post Event --}}
    <section class="derrick-container py-10">
        <h2 class="main-heading-2"><span>Post Event</span></h2>
        <div class="flex flex-col md:flex-row mx-auto">
            @foreach ($postEvent as $event)
                <a href="{{ route('event.detail', $event) }}" class="w-full md:w-1/4 p-2" data-aos="fadein"
                    data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="event-wrapper"
                        style="background-image: url('{{ asset('storage/events/photo/' . $event->photo) }}')">
                        <div class="event-content">
                            <img src="{{ asset('storage/events/logo/' . $event->logo) }}" class="mx-auto"
                                alt="Event Logo" width="100">
                            <strong class="block mt-5 text-HEADINGTEXT font-bold">{{ $event->name }}</strong><br>
                            <small class="font-light">{{ defaultDateFrom($event->start_date, $event->end_date) }}</small>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

@endsection
