@extends('admin._layouts.master')

@section('title', 'Competition')

{{-- @dd($registers->isPaid()) --}}

@section('body')
    @if ($registers)
        <div class="flex items-center mb-4 bg-PRIMARY p-4 md:p-8 rounded-md">
            <div class="w-36 h-36 md:flex justify-center items-center ml-5 mr-10 hidden ">
                <img src="{{ asset('storage/competition/logo/' . $registers->competition->logo) }}" class="w-36"
                    alt="">
            </div>
            <div class="text-sm w-full">
                <div class="flex flex-col-reverse justify-start items-start md:flex-row md:justify-between md:items-center">
                    <p class="text-gray-500 my-2">REG NO <strong>#{{ $registers->registration_number }}</strong></p>
                    <span
                        class="py-1 px-4 text-white shadow-sm rounded-md mb-2 md:mb-0 uppercase @if ($registers->isPaid()) bg-green-500 @else bg-yellow-500 @endif">
                        <i class="fas fa-fw @if ($registers->isPaid()) fa-circle-check @else fa-hourglass @endif"></i>
                        {{ $registers->isPaid() ? 'REGISTERED' : 'UNPAID' }}
                    </span>
                </div>
                <h3 class="font-bold text-xl mb-2">{{ $registers->competition->name }}</h3>
                <p class="text-gray-500 mb-3">
                    {{ defaultDateFrom($registers->competition->start_date, $registers->competition->end_date) }}</p>
                <p class="text-gray-500 mb-5">
                    {{ $registers->competition->description }}</p>

                <div class="flex gap-4">
                    <a href="{{ asset('storage/competition/guide_book/' . $registers->competition->guide_file) }}"
                        download="Guide Book ({{ $registers->competition->name }}).pdf"
                        class="text-SECONDARY hover:text-SECONDARY/80"><i class="fas fa-fw fa-book"></i> Registration
                        Booklet</a>
                    @if ($registers->isPaid())
                        <a target="_black" href="{{ route('registrant.ticket') }}"
                            class="text-SECONDARY hover:text-SECONDARY/80"><i class="fas fa-fw fa-ticket"></i> Competition
                            Ticket</a>
                    @endif
                </div>
                <hr class="border-TERTIARY my-3">
                <p class="italic text-gray-400">Team : {{ $registers->team_name }}</p>
                <div class="flex items-center mt-4 ml-1">
                    <div class="h-8 w-8 rounded-full bg-gray-400 shadow-sm overflow-hidden -ml-1">
                        <img src="{{ asset(auth()->user()->profile_image ? 'storage/profile/' . auth()->user()->profile_image : 'img/sample.png') }}"
                            class="w-8" alt="members">
                    </div>
                    @foreach ($registers->members as $member)
                        <div class="h-8 w-8 rounded-full bg-gray-400 shadow-sm overflow-hidden -ml-1">
                            <img src="{{ asset('storage/competition/registrant/photo/' . $member->photo) }}"
                                class="w-8" alt="members">
                        </div>
                    @endforeach
                    <a href="{{ route('registrant.member.create') }}"
                        class="text-SECONDARY hover:text-SECONDARY/80 ml-2 cursor-pointer"><i class="fas fa-fw fa-plus"></i>
                        Add Member</a>
                </div>

            </div>
        </div>
        @if ($registers->isPaid() ?? $registers->competition->wa_link != null)
            <div class="bg-PRIMARY p-4 md:p-8 rounded-md mb-4 flex justify-between items-center">
                <p>Please <strong>Join Whatsapp Group</strong> for more information about the events. <i
                        class="fas fa-fw fa-arrow-right text-green-500"></i></p>
                <a href="{{ $registers->competition->wa_link }}" target="_blank"
                    class="text-lg bg-green-500 hover:bg-green-500/80 text-white rounded-md py-2 px-4"><i
                        class="fab fa-fw fa-whatsapp"></i>
                    Join
                    whatsapp group</a>
            </div>
        @endif
        <div class="bg-PRIMARY p-4 md:p-8 rounded-md">
            <div class="flex justify-between">
                <h5 class="text-xs text-gray-500">Leader Profile:</h5>
                <a class="text-xs text-SECONDARY hover:text-SECONDARY/80" href="{{ route('profile') }}"><i
                        class="fas fa-fw fa-edit"></i> Edit Profile</a>
            </div>
            <hr class="my-3 border-TERTIARY">
            <div class="flex flex-col md:flex-row items-start gap-0 md:gap-8">
                <img src="{{ asset($registers->user->profile_image ? 'storage/profile/' . $registers->user->profile_image : 'img/sample.png') }}"
                    class="w-24 h-full rounded-lg mb-4 md:mb-0" alt="Leader's Photo">
                <table class="text-xs text-gray-500">
                    <tr>
                        <td>Name</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ auth()->user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <td>University</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ $registers->university }}</td>
                    </tr>
                    <tr>
                        <td>Major</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ $registers->major }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ $registers->phone_number }}</td>
                    </tr>
                </table>
                <table class="text-xs text-gray-500">
                    <tr>
                        <td>ID Card</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold text-SECONDARY hover:text-SECONDARY/80"><a
                                href="{{ asset('storage/competition/registrant/id_card/' . $registers->id_card) }}"
                                target="_blank">preview <i class="fas fa-fw fa-link"></i></a></td>
                    </tr>
                    <tr>
                        <td>Student Card</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold text-SECONDARY hover:text-SECONDARY/80"><a
                                href="{{ asset('storage/competition/registrant/student_card/' . $registers->student_card) }}"
                                target="_blank">preview <i class="fas fa-fw fa-link"></i></a></td>
                    </tr>
                </table>
            </div>
        </div>
    @else
        <div class="mb-4 bg-PRIMARY p-4 md:p-8 rounded-md">
            <h4 class="text-gray-500 mb-8">You have not registered yet</h4>
            <a href="{{ route('events') }}" class="py-2 px-4 text-white bg-SECONDARY rounded-md"><i
                    class="fas fa-fw fa-arrow-right"></i> Register
                Now</a>
        </div>
    @endif
@endsection
