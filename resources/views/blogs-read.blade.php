@extends('_layouts.main')

@section('title', $blog->title)

@section('body')
    <main class="derrick-container">
        <div class="mt-5 w-full h-full py-36 md:py-48 rounded-md"
            style="background-image: url('{{ $blog->image ? asset('storage/blog/' . $blog->image) : $blog->image_link }}'); background-size: cover; background-position: center center;">
        </div>
        <article class="py-3 md:py-8">
            <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
            <div class="mt-5 flex gap-5 text-sm text-gray-500">
                <h2>
                    <i class="mr-1 text-SECONDARY fas fa-fw fa-user"></i> {{ $blog->user->name }}
                </h2>
                <h2>
                    <i class="mr-1 text-SECONDARY fas fw-fa fa-calendar"></i> {{ defaultDate($blog->created_at) }}
                </h2>
                <h2>
                    <i class="mr-1 text-SECONDARY fas fw-fa fa-eye"></i> {{ $blog->views }}
                    {{ str()->plural('view', $blog->views) }}
                </h2>
            </div>
            <div class="mt-6">
                {!! $blog->content !!}
            </div>
        </article>
    </main>

@endsection
