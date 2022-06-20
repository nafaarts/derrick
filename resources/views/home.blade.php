@extends('_layouts.main')

@section('title', 'Home')

@section('head')
    <style>
        .hero::before {
            content: '';
            top: 0;
            left: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('filletSalmon.png') }}');
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
@endsection

@section('body')
    <div id="hero" class="bg-gradient-to-r from-SECONDARY to-orange-800 hero relative py-20 md:py-36 mb-10 md:mb-24">
        <div class="derrick-container">
            <div
                class="absolute bg-gradient-to-b md:bg-gradient-to-r from-white to-transparent opacity-75 h-full w-full md:w-1/2 z-0 top-0 left-0">
            </div>
            <div class="flex flex-col @if ($countdown) md:flex-row @endif gap-10 items-center z-10">
                <div class="w-full md:w-1/3 h-full z-10 flex justify-center items-center">
                    <img src="{{ asset('logo.png') }}" alt="Derrick {{ date('Y') }}" width="200">
                </div>
                <div class="w-full md:w-2/3 h-full z-10 md:mt-0 mt-10 text-center">
                    @if ($countdown)
                        @include('components.countdown')
                    @else
                        <div class="w-full flex justify-center items-center h-full">
                            <div class="text-PRIMARY">
                                <h1 class="font-extrabold text-5xl">
                                    DERRICK <span class="font-light">{{ date('Y') }}</span>
                                </h1>
                                <h5 class="mt-10 text-lg">“Retaliating to Future Energy Challanges by Developing
                                    Human-Intellectual
                                    Centered
                                    on Technological Innovation"</h5>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- about --}}
    <section id="about" class="derrick-container py-10 mb-10">
        <div class="flex flex-col md:flex-row gap-20">
            <div class="w-full md:w-3/5 h-full z-10" data-aos="fadein" data-aos-delay="100">
                <h2 class="text-2xl font-bold uppercase text-SECONDARY mb-8 underline underline-offset-8 tracking-wide">
                    About
                </h2>
                <p class="font-light md:text-left text-justify indent-8">
                    As an international event involving students throughout Indonesia and Southeast Asia, DERRICK 2022 is
                    determined to be an important part in the development of Indonesian Human Resources in accordance with
                    the development of society 5.0. With this, DERRICK 2022 seeks to be flexible in following and responding
                    to the very fast development pattern of the times in terms of energy transition. With the big theme
                    <strong>“Retaliating to Future Energy Challenges by Developing Human-Intellectual Centered on
                        Technological
                        Innovation”</strong>. This is manifested in the form of a competition which discusses the problems
                    that exist in
                    the energy sector today. Not only that, the brilliant innovations from the participants are our
                    contribution as the young people of the nation to be able to solve the existing problems.
                </p>
            </div>
            <div class="w-full md:w-2/5 h-full z-10" data-aos="fadein" data-aos-delay="200">
                <div class="w-full h-72 border-4 border-SECONDARY rounded-tr-3xl rounded-bl-3xl md:m-0 m-3"
                    x-data="{ play: false }" x-init="$watch('play', (value) => value ? $refs.video.play() : $refs.video.pause())">
                    <div class="w-full h-72 bg-SECONDARY rounded-tr-3xl rounded-bl-3xl z-20 -translate-x-3 md:-translate-x-5 -translate-y-5 overflow-hidden flex justify-center items-center"
                        x-on:scroll="console.log('scroll')">
                        <video x-ref="video" @click="play = !play">
                            <source src="{{ asset('derrick_teaser.mp4') }}" type="video/mp4">
                        </video>
                        <div @click="play = true" x-show="!play" x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="absolute inset-0 w-full h-full flex items-center justify-center">
                            <svg class="h-20 w-20 text-SECONDARY" fill="currentColor" viewBox="0 0 84 84">
                                <circle opacity="0.9" cx="42" cy="42" r="42" fill="white"></circle>
                                <path
                                    d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z">
                                </path>
                            </svg>
                        </div>
                        {{-- <img src="https://akamigas.ac.id/wp-content/uploads/2017/04/lokarina-1024x576.jpg"
                            alt="Random Image" class="w-full scale-125"> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- competition --}}
    @if ($competitions->count() > 0)
        <section id="competition" class="derrick-container py-10 mb-10">
            <h2
                class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
                Competition
            </h2>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                @foreach ($competitions as $competition)
                    <a href="{{ route('competition.detail', $competition) }}" data-aos="fadein"
                        data-aos-delay="{{ $loop->iteration * 200 }}" class="w-full md:w-1/4">
                        <div class=" event-wrapper"
                            style="background-image: url('{{ asset('storage/competition/photo/' . $competition->photo) }}')">
                            <div class="event-content">
                                <img src="{{ asset('storage/competition/logo/' . $competition->logo) }}" class="mx-auto"
                                    alt="competition Logo" width="100">
                                <strong
                                    class="block mt-5 text-HEADINGTEXT font-bold">{{ $competition->name }}</strong><br>
                                <small
                                    class="font-light">{{ defaultDateFrom($competition->start_date, $competition->end_date) }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- profile --}}
    @if (false)
        <section id="profile" class="derrick-container py-10 mb-10">
            <h2
                class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
                Profile of Blora
            </h2>
            <div class="mx-auto w-fit h-fit border-b-4 border-SECONDARY rounded-lg overflow-hidden" x-data=" { play: false }"
                x-init="$watch('play', (value) => value ? $refs.video.play() : $refs.video.pause())">
                <div class="overflow-hidden flex justify-center items-center relative">
                    <video x-ref="video" @click="play = !play" width="640" height="264">
                        <source src="{{ asset('derrick_teaser.mp4') }}" type="video/mp4">
                    </video>
                    <div @click="play = true" x-show="!play" x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="absolute inset-0 w-full h-full flex items-center justify-center">
                        <svg class="h-20 w-20 text-SECONDARY" fill="currentColor" viewBox="0 0 84 84">
                            <circle opacity="0.9" cx="42" cy="42" r="42" fill="white"></circle>
                            <path
                                d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z">
                            </path>
                        </svg>
                    </div>
                    {{-- <img src="https://akamigas.ac.id/wp-content/uploads/2017/04/lokarina-1024x576.jpg"
                                alt="Random Image" class="w-full scale-125"> --}}
                </div>
            </div>
        </section>
    @endif

    {{-- Speech From PM VPM --}}
    @if (false)
        <section id="speech" class="derrick-container py-10 mb-10">
            <h2
                class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
                speech from
                pm and vpm</h2>
            <div class="flex flex-col-reverse md:flex-row items-center mt-10 px-5 md:px-20">
                <div class="w-full md:w-2/3 p-5 text-center md:text-left" data-aos="fadein" data-aos-delay="200">
                    <h4 class="md:text-xl text-base font-sans mb-7">"Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.
                        Rem
                        aliquid
                        perferendis
                        et inventore!
                        Ipsum,
                        esse
                        voluptatibus placeat magnam voluptas quam quidem accusantium, dolores nulla vero, libero provident
                        suscipit
                        fuga minus"</h4>
                    <div class="flex md:flex-row flex-col md:justify-start justify-center gap-3">
                        <strong class="text-SECONDARY">AGUS BUDIMAN</strong>
                        <span class="font-light border-0 md:border-l-2 border-black pl-0 md:pl-3">PROJECT
                            MANAGER</span>
                    </div>
                </div>
                <div class="w-full md:w-1/3 p-2 flex justify-center md:justify-end">
                    <div class="rounded-full w-36 h-36 md:w-64 md:h-64 border-b-8 border-l-8 border-SECONDARY overflow-hidden"
                        data-aos="fadein" data-aos-delay="100">
                        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.bryantstratton.edu%2F~%2Fmedia%2Foutcomes-computer-support-specialist-300x250.ashx%3Fla%3Den%26hash%3DDE3A6B3B77B0B9BF0ECAEF6D104C306615AF37BD&f=1&nofb=1"
                            alt="PM" class="w-full scale-150">
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center mt-10 px-5 md:px-20">
                <div class="w-full md:w-1/3 p-2 flex justify-center md:justify-start">
                    <div class="rounded-full w-36 h-36 md:w-64 md:h-64 border-b-8 border-l-8 border-SECONDARY overflow-hidden"
                        data-aos="fadein" data-aos-delay="100">
                        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.bryantstratton.edu%2F~%2Fmedia%2Foutcomes-computer-support-specialist-300x250.ashx%3Fla%3Den%26hash%3DDE3A6B3B77B0B9BF0ECAEF6D104C306615AF37BD&f=1&nofb=1"
                            alt="PM" class="w-full scale-150">
                    </div>
                </div>
                <div class="w-full md:w-2/3 p-5 text-center md:text-left" data-aos="fadein" data-aos-delay="200">
                    <h4 class="md:text-xl text-base font-sans mb-7">"Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.
                        Rem
                        aliquid
                        perferendis
                        et inventore!
                        Ipsum,
                        esse
                        voluptatibus placeat magnam voluptas quam quidem accusantium, dolores nulla vero, libero provident
                        suscipit
                        fuga minus"</h4>
                    <div class="flex md:flex-row flex-col md:justify-start justify-center gap-3">
                        <strong class="text-SECONDARY">AGUS BUDIMAN</strong>
                        <span class="font-light border-0 md:border-l-2 border-black pl-0 md:pl-3">VICE PROJECT
                            MANAGER</span>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($preEvent) > 0)
        {{-- Pre Event --}}
        <section id="pre-event" class="derrick-container py-10 mb-10">
            <h2
                class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
                Pre Event
            </h2>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                @foreach ($preEvent as $event)
                    <a href="{{ route('event.detail', $event) }}" class="w-full md:w-1/4" data-aos="fadein"
                        data-aos-delay="{{ $loop->iteration * 200 }}">
                        <div class="event-wrapper"
                            style="background-image: url('{{ asset('storage/events/photo/' . $event->photo) }}')">
                            <div class="event-content">
                                <img src="{{ asset('storage/events/logo/' . $event->logo) }}" class="mx-auto"
                                    alt="Event Logo" width="100">
                                <strong class="block mt-5 text-HEADINGTEXT font-bold">{{ $event->name }}</strong><br>
                                <small
                                    class="font-light">{{ defaultDateFrom($event->start_date, $event->end_date) }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    @if (count($postEvent) > 0)
        {{-- Post Event --}}
        <section id="post-event" class="derrick-container py-10 mb-10">
            {{-- <h2 class="main-heading-2"><span>Post Event</span></h2> --}}
            <h2
                class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
                Post Event
            </h2>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                @foreach ($postEvent as $event)
                    <a href="{{ route('event.detail', $event) }}" class="w-full md:w-1/4" data-aos="fadein"
                        data-aos-delay="{{ $loop->iteration * 200 }}">
                        <div class="event-wrapper"
                            style="background-image: url('{{ asset('storage/events/photo/' . $event->photo) }}')">
                            <div class="event-content">
                                <img src="{{ asset('storage/events/logo/' . $event->logo) }}" class="mx-auto"
                                    alt="Event Logo" width="100">
                                <strong class="block mt-5 text-HEADINGTEXT font-bold">{{ $event->name }}</strong><br>
                                <small
                                    class="font-light">{{ defaultDateFrom($event->start_date, $event->end_date) }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- crews --}}
    <section id="crews" class="derrick-container py-10 mb-10">
        <h2
            class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
            Meet our crews
        </h2>
        <div class="flex flex-wrap gap-14 md:gap-20 justify-center">
            @foreach ($crews as $crew)
                <div data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}" class="p-2">
                    <div class="group relative hover:scale-110 transition-all">
                        <img src="{{ asset('storage/committees/' . $crew->photo) }}" alt="{{ $crew->name }}"
                            class="h-36 md:h-56">
                        <div
                            class="absolute opacity-0 group-hover:opacity-100 flex h-full w-full top-0 left-0 justify-center items-end transition-all">
                            <div
                                class="flex gap-2 text-lg md:text-2xl text-SECONDARY bg-white p-0 md:py-2 px-6 w-fit h-fit rounded-lg text-center">
                                <a class="cursor-pointer" target="_blank" href="{{ $crew->instagram }}"><i
                                        class="fab fa-fw fa-instagram-square"></i></a>
                                <a class="cursor-pointer" target="_blank" href="{{ $crew->linkedin }}"><i
                                        class="fab fa-fw fa-linkedin"></i></a>
                                <a class="cursor-pointer" target="_blank" href="https://wa.me/{{ $crew->phone }}"><i
                                        class="fab fa-fw fa-whatsapp-square"></i></a>
                                <a class="cursor-pointer" target="_blank" href="mailto:{{ $crew->email }}"><i
                                        class="fas fa-fw fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Organized --}}
    <section id="organized" class="derrick-container py-10 mb-10">
        <h2
            class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
            Organized By
        </h2>
        <div class="flex flex-wrap justify-center gap-20">
            @foreach ($organized as $item)
                <img data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}"
                    src="{{ asset('storage/sponsors/' . $item->logo) }}" alt="{{ $item->name }}"
                    class="h-24 md:h-36">
            @endforeach
        </div>
    </section>

    {{-- supported --}}
    <section id="supported" class="derrick-container py-10 mb-10">
        <h2
            class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
            Supported By
        </h2>
        <div class="flex flex-wrap justify-center gap-20">
            @foreach ($supported as $item)
                <img data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}"
                    src="{{ asset('storage/sponsors/' . $item->logo) }}" alt="{{ $item->name }}"
                    class="h-16 md:h-24">
            @endforeach
        </div>
    </section>

    @if ($blogs->count() > 0)
        {{-- Blog --}}
        <section id="blogs" class="derrick-container py-10 mb-10">
            <h2
                class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
                Latest
                Updates
            </h2>
            <div class="flex flex-wrap">
                @foreach ($blogs as $blog)
                    <div class="p-4 w-full md:w-1/3 transition-all" data-aos="fadein"
                        data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="h-full bg-white/50 hover:bg-white/75 rounded-tr-3xl overflow-hidden">
                            <a href="{{ route('blog.read', $blog) }}">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="{{ $blog->image ? asset('storage/blog/' . $blog->image) : $blog->image_link }}"
                                    alt="blog">
                            </a>
                            <div class="p-6">
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $blog->title }}</h1>
                                <p class="leading-relaxed mb-3 font-light">{{ $blog->headline }}</p>
                                <div class="flex items-center flex-wrap ">
                                    <a href="{{ route('blog.read', $blog) }}"
                                        class="text-SECONDARY inline-flex items-center md:mb-2 lg:mb-0">Read More
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
    @endif

@endsection
