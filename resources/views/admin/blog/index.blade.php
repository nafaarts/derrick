@extends('admin._layouts.master')

@section('title', 'Blog')

@section('head')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('body')
    <div class="container text-xs">
        <div class="min-h-screen">
            <div class="gap-3 @if ($blogs->count() > 4) md:columns-4 columns-2xl @else flex @endif">
                @foreach ($blogs as $blog)
                    <div class="@if ($blogs->count() > 4) mx-auto mb-3 [break-inside:avoid] @else w-1/4 @endif"
                        data-aos="fadein" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="bg-white/50 hover:bg-white/75 rounded-lg max-w-sm mb-5">
                            <div class="relative rounded-t-lg overflow-hidden">
                                <img src="{{ $blog->image ? asset('storage/blog/' . $blog->image) : $blog->image_link }}"
                                    alt="{{ $blog->slug }}" class="w-full">
                                <div class="absolute top-3 px-3 text-white flex justify-between w-full">
                                    <div class="bg-black rounded-md bg-opacity-50 p-2">
                                        <i class="fas fa-fw fa-eye"></i> {{ $blog->views ?? 0 }}
                                    </div>
                                    <div class="bg-black rounded-md bg-opacity-50 p-2">
                                        <a href="{{ route('blog.edit', $blog) }}" class="hover:text-orange-300"><i
                                                class="fas fa-fw fa-edit"></i></a>
                                        <form action="{{ route('blog.destroy', $blog) }}" method="post"
                                            class="inline" onsubmit="return confirmDelete(this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 hover:text-orange-300"><i
                                                    class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="flex justify-between mb-2 items-center">
                                    <small
                                        class="inline-block rounded-full px-2 font-bold text-white {{ $blog->status == 'published' ? 'bg-green-400' : 'bg-yellow-400' }}">{{ $blog->status == 'published' ? 'PUBLISHED' : 'DRAFT' }}</small>
                                    <span class="text-xs text-gray-600">{{ $blog->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="#">
                                    <h5 class="text-gray-900 font-bold tracking-tight mb-2">{{ $blog->title }}
                                    </h5>
                                </a>
                                <p class="font-normal text-gray-700">{{ $blog->headline }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('blog.create') }}"
            class="h-14 w-14 flex justify-center items-center absolute bottom-8 right-8 bg-orange-400 rounded-full text-white hover:bg-orange-600"><i
                class="fas fa-fw fa-add"></i></a>
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
