@extends('admin._layouts.master')

@section('title', 'Registrant of ' . $event->name)

@section('body')
    <div class="flex justify-between">
        <a href="{{ route('event.index') }}" class="text-xs text-orange-800 rounded-md"><i
                class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
        <a href="{{ route('event.registrant.export', $event) }}" class="text-xs text-orange-800 rounded-md">Export XLS<i
                class="fas fa-fw fa-file-excel ml-2"></i></a>
    </div>
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <h3 class="font-bold">{{ $event->name }}</h3>
            @include('components.search', ['route' => route('event.registrant', $event)])
        </div>
        <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg font-medium text-gray-700 text-left">
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Name</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Email</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Education</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Status</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Resident</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Institution</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Major</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Phone</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Remark</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Created At</th>
                        <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($registrant as $person)
                        <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->email }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->education_level }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->current_status }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->resident }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->institution }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->major }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->phone }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->remark }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $person->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <form action="{{ route('event.registrant.delete', $person) }}" method="POST"
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
