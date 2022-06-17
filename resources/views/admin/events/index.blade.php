@extends('admin._layouts.master')

@section('title', 'Events')

@section('body')
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <h3 class="font-bold">List of Events</h3>
            @include('components.search', ['route' => route('event.index')])
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
                    @foreach ($events as $event)
                        <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                            <td class="px-4 py-2"><img src="{{ asset('storage/events/logo/' . $event->logo) }}"
                                    class="rounded-full w-10 h-10">
                            </td>
                            <td class="px-4 py-2">
                                <div class="font-bold">{{ $event->name }}</div>
                                <div class="text-gray-400 mt-1">
                                    <span class="text-gray-500">{{ $event->category }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <small
                                    class="inline-block rounded-full px-2 font-bold text-white {{ $event->status ? 'bg-green-400' : 'bg-yellow-400' }}">{{ $event->status ? 'PUBLISHED' : 'DRAFT' }}</small>
                            </td>
                            <td class="px-4 py-2"><i class="fas fa-eye"></i> {{ $event->views ?? 0 }}</td>
                            <td class="px-4 py-2">
                                <strong>{{ defaultDateFrom($event->start_date, $event->end_date) }}</strong>
                            </td>
                            <td class="px-4 py-2">
                                @if ($event->registration_required)
                                    <a href="{{ route('event.registrant', $event) }}"
                                        class="py-1 px-2 bg-SECONDARY hover:bg-SECONDARY/80 text-white rounded-md text-xs">
                                        <i class="fas fa-fw fa-user"></i>
                                        {{ $event->registrant->count() ?? 0 }}
                                    </a>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $event->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-2">
                                <a class="hover:text-orange-400 mr-2" href="{{ route('event.edit', $event) }}"><i
                                        class="fas fw-fw fa-edit"></i></a>
                                <form action="{{ route('event.destroy', $event) }}" method="POST" class="inline"
                                    onsubmit="return confirmDelete(this)">
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
        {{ $events->links() }}
    </div>

    <a href="{{ route('event.create') }}"
        class="h-14 w-14 flex justify-center items-center absolute bottom-8 right-8 bg-orange-400 rounded-full text-white hover:bg-orange-600"><i
            class="fas fa-fw fa-add"></i></a>

@endsection
