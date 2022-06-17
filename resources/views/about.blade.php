@extends('_layouts.main')

@section('title', 'About Us')

@section('body')
    @include('components.label', ['label' => 'About Us'])

    <section id="about" class="derrick-container py-10 mb-10">
        <p class="font-light md:text-left text-justify indent-8 mb-4" data-aos="fadein" data-aos-delay="100">
            <strong>PEM Akamigas Cepu</strong> is a university under the Ministry of Energy and Mineral Resources of
            the Republic of
            Indonesia which has a vision to become the Best Energy and Mineral Polytechnic in Indonesia with
            international standards. To achieve this vision, the Exploration and Production Student Association, the
            Ikatan Ahli Teknik Perminyakan Indonesia Seksi Mahasiswa PEM Akamigas Cepu (IATMI SM PEM Akamigas Cepu)
            and the Society of Petroleum Engineer PEM Akamigas Student Chapter have committed to work together in
            organizing the DERRICK 2022 event after their success in held this event for 5 (five) consecutive years.
            DERRICK is the largest annual activity of the Exploration & Production Student Association with the main
            event being a competition in the oil and gas sector.
        </p>
        <p class="font-light md:text-left text-justify indent-8 mb-4" data-aos="fadein" data-aos-delay="200">As an
            international
            event involving students
            throughout Indonesia and Southeast Asia, DERRICK 2022 is
            determined to be an important part in the development of Indonesian Human Resources in accordance with
            the development of society 5.0.</p>
        <p class="font-light md:text-left text-justify indent-8" data-aos="fadein" data-aos-delay="300">
            With this, DERRICK 2022 seeks to be flexible in following and responding
            to the very fast development pattern of the times in terms of energy transition. With the big theme
            <strong>“Retaliating to Future Energy Challenges by Developing Human-Intellectual Centered on
                Technological
                Innovation”</strong>. This is manifested in the form of a competition which discusses the problems
            that exist in
            the energy sector today. Not only that, the brilliant innovations from the participants are our
            contribution as the young people of the nation to be able to solve the existing problems. Apart from the
            core activities of DERRICK 2022, there are also non-competition activities which are of course very
            useful for developing critical thinking patterns for Human Resources. Another agenda is to bring
            together students from all universities in Southeast Asia to exchange ideas, ideas and build
            relationships. On the other hand, it is also a media branding about PEM Akamigas Cepu to the outside
            world.
        </p>
    </section>

    {{-- crews --}}
    <section id="crews" class="derrick-container py-10 mb-10">
        <h2
            class="text-2xl font-bold uppercase text-SECONDARY block mb-20 underline underline-offset-8 tracking-wide text-center">
            Commettees
        </h2>
        <div class="flex flex-wrap gap-14 md:gap-20 justify-center">
            @foreach ($crews as $item)
                <img data-aos="fadein" data-aos-delay="{{ $loop->iteration * 200 }}"
                    src="{{ asset('storage/committees/' . $item->photo) }}" alt="{{ $item->name }}"
                    class="h-36 md:h-56">
            @endforeach
        </div>
    </section>

@endsection
