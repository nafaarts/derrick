@extends('admin._layouts.master')

@section('title', 'Members of ' . $registrant->team_name)

@section('body')
    <div class="flex justify-between">
        <a href="{{ route('competition.registrant', $registrant->competition) }}"
            class="text-xs text-orange-800 rounded-md"><i class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    </div>
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <div>
                <h2 class="font-light text-gray-600 mb-2">{{ $registrant->team_name }}</h2>
                <h3 class="font-bold">{{ $registrant->competition->name }}</h3>
            </div>
            @include('components.search', ['route' => route('competition.registrant.member', $registrant)])
        </div>
        <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg font-medium text-gray-700 text-left">
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Photo</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Name</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Email</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Phone</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Major</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Created At</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($members as $person)
                        <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/competition/registrant/photo/' . $person->photo) }}"
                                    class="w-8 h-8 rounded-full" alt="">
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap font-bold">{{ $person->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->email }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->phone_number }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->major }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
