@extends('_layouts.main')

@section('title', 'Thank You')

@section('head')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection

@section('body')
    <div class="derrick-container py-20 text-center">
        <div class="flex flex-col items-center justify-center">
            <lottie-player src="{{ asset('lf30_editor_fsmrmypj.json') }}" background="transparent" speed="1"
                style="width: 200px; height: 200px;" autoplay></lottie-player>
            <h1 class="font-extrabold text-5xl md:text-8xl text-SECONDARY">
                Thank You</h1>
        </div>
        <hr class="w-48 mx-auto border-2 border-SECONDARY bg-SECONDARY my-5">
        <p class="font-light">You have registered for this <br class="block md:hidden">
            <strong>{{ $name }}</strong>
            {{ $category ?? '' }}
        </p>
        @if (request()->has('order_id') && request()->has('transaction_status'))
            <div class=" mt-5 md:mt-2">
                <strong>{{ $message ?? '' }}</strong>
                <p class="font-light text-xs mt-2">
                    Your Order ID <strong>{{ request()->get('order_id') }}</strong>
                </p>
            </div>
            @auth
                <div class="block mt-10">
                    <a class="py-2 px-4 bg-SECONDARY hover:bg-SECONDARY/80 rounded-md text-white"
                        href="{{ route('registrant.competition') }}">
                        Registration Detail <i class="fas fa-fw fa-arrow-right"></i></a>
                </div>
            @endauth
        @else
            <div class="block mt-10">
                <a class="py-2 px-4 bg-SECONDARY hover:bg-SECONDARY/80 rounded-md text-white"
                    href="{{ route('home') }}"><i class="fas fa-fw fa-arrow-left"></i>
                    Back to Home</a>
            </div>
        @endif
    </div>
@endsection
