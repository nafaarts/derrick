@extends('admin._layouts.master')

@section('title', 'Members')

@section('body')
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <h3 class="font-bold">Members</h3>
            @include('components.search', ['route' => route('registrant.member.index')])
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
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Action</th>
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
                            <td class="px-4 py-4 whitespace-nowrap">
                                <a href="{{ route('registrant.member.edit', $person->id) }}"
                                    class="hover:text-orange-400"><i class="fas fa-fw fa-edit"></i></a>
                                <form action="{{ route('registrant.member.destroy', $person) }}" method="POST"
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
            <small class="text-gray-500 mt-3 block">Max Allowed Member : {{ $register->competition->max_member }}</small>
        </div>
    </div>

    <a href="{{ route('registrant.member.create') }}"
        class="h-14 w-14 flex justify-center items-center absolute bottom-8 right-8 bg-orange-400 rounded-full text-white hover:bg-orange-600"><i
            class="fas fa-fw fa-add"></i></a>

@endsection
