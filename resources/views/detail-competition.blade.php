@extends('_layouts.main')

@section('title', $competition->name)

@section('body')
    <div class="main-event"
        style="background-image: url('{{ asset('storage/competition/photo/' . $competition->photo) }}')">
        <div class="py-10 md:py-20 bg-gradient-to-r from-BACKGROUND to-transparent w-full">
            <div class="derrick-container flex md:flex-row flex-col-reverse">
                <div class="w-full md:w-1/2 space-y-8 p-5 text-center md:text-left">
                    <h2 class="font-extrabold text-5xl text-PRIMARY">
                        {{ $competition->name }}
                    </h2>

                    {{-- <h2
                        class="font-extrabold text-transparent text-5xl bg-clip-text bg-gradient-to-r from-orange-500 to-HEADINGTEXT">
                        {{ $competition->name }}
                    </h2> --}}
                    {{-- <div class="text-white flex items-center space-x-3 md:mx-0 mx-auto w-fit">
                        <div class="flex h-3 w-3">
                            <div class="bg-green-500 relative inline-flex rounded-full h-3 w-3">
                            </div>
                        </div>
                        <span>{{ $competition->getStatus() }}</span>
                    </div> --}}

                    <div class="flex md:mx-0 mx-auto w-fit gap-10">
                        <div class="text-white">
                            <small>Registration Fee : </small>
                            <p class="font-medium">
                                IDR {{ number_format($competition->getCurrentPrice()) }}
                            </p>
                        </div>
                        {{-- <div class="text-white">
                            <small>Views :</small>
                            <p class="font-light">{{ $competition->views }} <i class="fas fa-fw fa-eye"></i></p>
                        </div> --}}
                    </div>

                    <div class="flex md:mx-0 mx-auto w-fit gap-10">
                        <div class="text-white">
                            <small>Registration Batch 1 : </small>
                            <p class="font-medium">
                                {{ defaultDateFrom($competition->date_reg_start_first_batch, $competition->date_reg_end_first_batch) }}
                            </p>
                        </div>
                        <div class="text-white">
                            <small>Registration Batch 2 : </small>
                            <p class="font-medium">
                                {{ defaultDateFrom($competition->date_reg_start_second_batch, $competition->date_reg_end_second_batch) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex space-x-3 md:mx-0 mx-auto w-fit">
                        <button
                            @if (!$competition->getRegistrationStatus('is_open')) disabled @else onclick="return window.location.href = '{{ route('competition.register', $competition) }}'" @endif
                            class="py-2 px-6 rounded-md bg-SECONDARY hover:bg-SECONDARY/75 text-white">
                            <i class="fas fa-fw fa-hand-pointer rotate-45 mr-1"></i>
                            Register Competition
                        </button>
                        <a href="{{ asset('storage/competition/guide_book/' . $competition->guide_file) }}"
                            download="Guide Book ({{ $competition->name }}).pdf"
                            class="py-2 px-6 rounded-md border border-SECONDARY hover:bg-SECONDARY/50 text-white">
                            <i class="fas fa-fw fa-book"></i>
                            Registration Booklet
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex items-center justify-center">
                    <img src="{{ asset('storage/competition/logo/' . $competition->logo) }}" alt="competition Logo"
                        width="250">
                </div>
            </div>
            <div class="p-10 mt-10 derrick-container">
                <hr class="border-white/50">
                <p class="text-white mt-10 text-center md:text-left">{{ $competition->description }}</p>
            </div>
        </div>
    </div>

@endsection
