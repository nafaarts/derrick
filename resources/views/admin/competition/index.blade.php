@extends('admin._layouts.master')

@section('title', 'Competition')

@section('body')
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <h3 class="font-bold">List of Competitions</h3>
            @include('components.search', ['route' => route('competition.index')])
        </div>
        <div class="overflow-x-auto mt-6 rounded-md overflow-hidden">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg font-medium text-gray-700 text-left">
                        <th class="px-4 py-2 bg-TERTIARY">Logo</th>
                        <th class="px-4 py-2 bg-TERTIARY">Title</th>
                        <th class="px-4 py-2 bg-TERTIARY">Status</th>
                        <th class="px-4 py-2 bg-TERTIARY">Views</th>
                        <th class="px-4 py-2 bg-TERTIARY">Date</th>
                        <th class="px-4 py-2 bg-TERTIARY">Registrant</th>
                        <th class="px-4 py-2 bg-TERTIARY">Created At</th>
                        <th class="px-4 py-2 bg-TERTIARY">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($competitions as $competition)
                        <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                            <td class="px-4 py-2"><img src="{{ asset('storage/competition/logo/' . $competition->logo) }}"
                                    class="rounded-full w-10 h-10">
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="font-bold">
                                    {{ $competition->name }}
                                </div>
                                <small>{{ $competition->code }}</small>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <small
                                    class="inline-block rounded-full px-2 font-bold text-white {{ $competition->status ? 'bg-green-400' : 'bg-yellow-400' }}">{{ $competition->status ? 'PUBLISHED' : 'DRAFT' }}</small>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap"><i class="fas fa-eye"></i>
                                {{ $competition->views ?? 0 }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <strong>{{ defaultDateFrom($competition->start_date, $competition->end_date) }}</strong>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <a href="{{ route('competition.registrant', $competition) }}"
                                    class="py-1 px-2 bg-SECONDARY hover:bg-SECONDARY/80 text-white rounded-md text-xs">
                                    <i class="fas fa-fw fa-user"></i>
                                    {{ $competition->registrant->count() }}
                                </a>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $competition->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <a class="hover:text-orange-400 mr-2"
                                    href="{{ route('competition.edit', $competition) }}"><i
                                        class="fas fw-fw fa-edit"></i></a>
                                <form action="{{ route('competition.destroy', $competition) }}" method="POST"
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
        <div class="mt-3">
            {{ $competitions->links() }}
        </div>
    </div>

    <a href="{{ route('competition.create') }}"
        class="h-14 w-14 flex justify-center items-center absolute bottom-8 right-8 bg-orange-400 rounded-full text-white hover:bg-orange-600"><i
            class="fas fa-fw fa-add"></i></a>

@endsection
