@extends('_layouts.main')

@section('title', 'Sponsors')

@section('body')
    @include('components.label', ['label' => 'Sponsor'])

    {{-- gold --}}
    @if ($gold)
        <section id="gold" class="derrick-container py-20 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/3">
                <h2
                    class="text-xl md:text-2xl font-bold uppercase text-SECONDARY block md:mb-0 mb-20 underline underline-offset-8 tracking-wide text-center">
                    gold
                </h2>
            </div>
            <div class="w-full md:w-2/3 flex flex-wrap gap-10">
                @foreach ($gold as $item)
                    <img data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}"
                        src="{{ asset('storage/sponsors/' . $item->logo) }}" alt="{{ $item->name }}"
                        class="mx-auto h-20 md:h-28">
                @endforeach
            </div>
        </section>

        <div class="derrick-container">
            <hr class="border-TERTIARY">
        </div>
    @endif

    {{-- silver --}}
    @if ($silver)
        <section id="silver" class="derrick-container py-20 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/3">
                <h2
                    class="text-xl md:text-2xl font-bold uppercase text-SECONDARY block md:mb-0 mb-20 underline underline-offset-8 tracking-wide text-center">
                    silver
                </h2>
            </div>
            <div class="w-full md:w-2/3 flex flex-wrap gap-10">
                @foreach ($silver as $item)
                    <img data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}"
                        src="{{ asset('storage/sponsors/' . $item->logo) }}" alt="{{ $item->name }}"
                        class="mx-auto h-14 md:h-24">
                @endforeach
            </div>
        </section>

        <div class="derrick-container">
            <hr class="border-TERTIARY">
        </div>
    @endif

    {{-- bronze --}}
    @if ($bronze)
        <section id="bronze" class="derrick-container py-20 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/3">
                <h2
                    class="text-xl md:text-2xl font-bold uppercase text-SECONDARY block md:mb-0 mb-20 underline underline-offset-8 tracking-wide text-center">
                    bronze
                </h2>
            </div>
            <div class="w-full md:w-2/3 flex flex-wrap gap-10">
                @foreach ($bronze as $item)
                    <img data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}"
                        src="{{ asset('storage/sponsors/' . $item->logo) }}" alt="{{ $item->name }}"
                        class="mx-auto h-14 md:h-20">
                @endforeach
            </div>
        </section>
    @endif

@endsection
