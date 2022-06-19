@extends('admin._layouts.master')

@section('title', 'Registrant of ' . $competition->name)

@section('body')
    <div class="flex justify-between">
        <a href="{{ route('competition.index') }}" class="text-xs text-orange-800 rounded-md"><i
                class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
        <a href="{{ route('competition.registrant.export', $competition) }}"
            class="text-xs text-orange-800 rounded-md">Export
            XLS<i class="fas fa-fw fa-file-excel ml-2"></i></a>
    </div>
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <h3 class="font-bold">{{ $competition->name }}</h3>
            @include('components.search', ['route' => route('competition.registrant', $competition)])
        </div>
        <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg font-medium text-gray-700 text-left">
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Photo</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Team</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Status</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Leader</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Email</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Major</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">University</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Phone</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Member</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Created At</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($registrant as $person)
                        <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/profile/' . $person->user->profile_image) }}"
                                    class="w-8 h-8 rounded-full" alt="">
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <h4>
                                    <strong>
                                        <a
                                            href="{{ route('search') . '?q=' . $person->registration_number }}">{{ $person->team_name }}</a>
                                    </strong>
                                </h4>
                                <small>{{ $person->registration_number }}</small>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if ($person->isPaid())
                                    <span class="px-2 py-1 bg-green-500 text-white rounded-md">
                                        <i class="fas fa-fw fa-check"></i>
                                        {{ $person->latestPayment()->transaction_status ?? '' }}
                                    </span>
                                @elseif($person->latestPayment()->transaction_status == 'expire')
                                    <span class="px-2 py-1 bg-red-500 text-white rounded-md">
                                        <i class="fas fa-fw fa-times"></i>
                                        {{ $person->latestPayment()->transaction_status ?? '' }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-500 text-white rounded-md">
                                        <i class="fas fa-fw fa-hourglass"></i>
                                        {{ $person->latestPayment()->transaction_status ?? '' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->user->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->user->email }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->major }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->university }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->phone_number }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <a href="{{ route('competition.registrant.member', $person) }}"
                                    class="py-1 px-2 bg-SECONDARY hover:bg-SECONDARY/80 text-white rounded-md text-xs">
                                    <i class="fas fa-fw fa-user"></i>
                                    {{ $person->members->count() }} of {{ $competition->max_member }}
                                </a>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <form action="{{ route('competition.registrant.delete', $person) }}" method="POST"
                                    class="inline" onsubmit="return confirmDelete(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="hover:text-orange-400" type="submit"><i
                                            class="fas fa-fw fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $registrant->links() }}
    </div>


@endsection
