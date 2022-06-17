@extends('_layouts.main')

@section('title', 'Information')

@section('body')

    @include('components.label', ['label' => 'Information'])

    <section id="competition" class="derrick-container py-10">
        <div class="flex flex-wrap">
            @foreach ($blogs as $blog)
                <div class="px-4 pb-4 md:w-1/3 hover:scale-105 transition-all" data-aos="fadein"
                    data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="h-full bg-white/50 hover:bg-white/75 rounded-tr-3xl overflow-hidden">
                        <a href="{{ route('blog.read', $blog) }}">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                src="{{ $blog->image ? asset('storage/blog/' . $blog->image) : $blog->image_link }}"
                                alt="blog">
                        </a>
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $blog->title }}</h1>
                            <p class="leading-relaxed mb-3">{{ $blog->headline }}</p>
                            <div class="flex items-center flex-wrap ">
                                <a href="{{ route('blog.read', $blog) }}"
                                    class="text-SECONDARY inline-flex items-center md:mb-2 lg:mb-0">Read More
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <span
                                    class="text-gray-400 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm py-1">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>{{ $blog->views }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
