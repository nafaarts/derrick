@extends('admin._layouts.master')

@section('title', 'Gallery')

@section('head')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('body')
    <div class="container">
        <div class="min-h-screen">
            <div class="gap-3 @if ($galleries->count() < 4) flex @else md:columns-4 columns-2 @endif">
                @foreach ($galleries as $gallery)
                    <div class="@if ($galleries->count() < 4) w-1/4 @else mx-auto mb-3 [break-inside:avoid] @endif"
                        data-aos="fadein" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="bg-white/50 hover:bg-white/75 rounded-md overflow-hidden text-xs">
                            <div class="relative">
                                <img src="{{ $gallery->image ? asset('storage/gallery/' . $gallery->image) : $gallery->link }}"
                                    alt="{{ $gallery->alt }}" class="w-full">
                                <div class="absolute top-3 px-3 text-white flex w-full justify-end">
                                    <div class="bg-black rounded-md bg-opacity-50 p-2">
                                        <a href="{{ route('gallery.edit', $gallery) }}" class="hover:text-orange-300"><i
                                                class="fas fa-fw fa-edit"></i></a>

                                        <form action="{{ route('gallery.destroy', $gallery) }}" method="post"
                                            class="inline" onsubmit="return confirmDelete(this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 hover:text-orange-300"><i
                                                    class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
            <a href="{{ route('gallery.create') }}"
                class="h-14 w-14 flex justify-center items-center absolute bottom-8 right-8 bg-orange-400 rounded-full text-white hover:bg-orange-600"><i
                    class="fas fa-fw fa-add"></i></a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
@endsection
