@extends('_layouts.main')

@section('title', 'Gallery')

@section('body')
    @include('components.label', ['label' => 'Gallery'])

    <section id="competition" class="derrick-container py-10" x-data="{ description: '', showModal: false }">
        <div class="flex flex-wrap flex-row w-full">
            <div id="lightgallery" class="gap-4 @if ($galleries->count() < 4) flex @else md:columns-4 columns-2 @endif">
                @foreach ($galleries as $gallery)
                    <div class="@if ($galleries->count() < 4) w-1/4 @else mx-auto mb-3 [break-inside:avoid] @endif"
                        data-aos="fadein" data-aos-delay="{{ $loop->iteration * 100 }}"
                        x-on:click="showModal = !showModal,$refs.image.src = '{{ $gallery->image ? asset('storage/gallery/' . $gallery->image) : $gallery->link }}',description = '{{ $gallery->description }}'">
                        <div class="bg-white/50 hover:bg-white/75 rounded-md overflow-hidden text-xs">
                            <img src="{{ $gallery->image ? asset('storage/gallery/' . $gallery->image) : $gallery->link }}"
                                alt="{{ $gallery->alt }}" class="w-full">
                            @if ($gallery->description != null)
                                <div class="p-2">
                                    <small class="text-gray-600"><strong>{{ $gallery->user->name }}</strong>
                                        {{ $gallery->description }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="fixed flex justify-center items-center top-0 left-0 w-full h-screen z-50"
            :class="{ 'bg-black/50': showModal }" x-show="showModal">
            <div class="relative overflow-hidden w-full mx-10 md:w-auto md:mx-auto md:max-w-xl"
                x-on:click.away="showModal=false" x-show="showModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-0" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300 " x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-0">
                <div class="cursor-pointer absolute top-3 right-3 text-white text-2xl" x-on:click="showModal=false">
                    <i class="fas fa-fw fa-times"></i>
                </div>
                <div x-show="description != ''"
                    class="absolute bottom-0 text-white text-xs text-center z-50 w-full py-5 md:py-10 bg-gradient-to-t from-black/80 to-transparent">
                    <p x-text="description"></p>
                </div>
                <img x-ref="image" alt="images" class="h-full w-full">
            </div>
        </div>

    </section>

@endsection
