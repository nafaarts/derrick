@extends('admin._layouts.master')

@section('title', 'Sponsor')

@section('body')
    <div class="bg-PRIMARY pb-4 px-4 rounded-md w-full text-xs">
        <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start pt-5 gap-4">
            <h3 class="font-bold">List of Sponsor</h3>
            @include('components.search', ['route' => route('sponsor.index')])
        </div>
        <div class="overflow-x-auto mt-6 rounded-md overflow-hidden">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg font-medium text-gray-700 text-left">
                        <th class="px-4 py-2 bg-TERTIARY">Logo</th>
                        <th class="px-4 py-2 bg-TERTIARY">Title</th>
                        <th class="px-4 py-2 bg-TERTIARY">Status</th>
                        <th class="px-4 py-2 bg-TERTIARY">Type</th>
                        <th class="px-4 py-2 bg-TERTIARY">Created At</th>
                        <th class="px-4 py-2 bg-TERTIARY">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($sponsors as $sponsor)
                        <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/sponsors/' . $sponsor->logo) }}"
                                    class="h-10 bg-zinc-300 rounded-md">
                            </td>
                            <td class="px-4 py-2">
                                <div class="font-bold">{{ $sponsor->name }}</div>
                            </td>
                            <td class="px-4 py-2">
                                <small
                                    class="inline-block rounded-full px-2 font-bold text-white {{ $sponsor->status ? 'bg-green-400' : 'bg-yellow-400' }}">{{ $sponsor->status ? 'PUBLISHED' : 'DRAFT' }}</small>
                            </td>
                            <td class="px-4 py-2 uppercase">
                                <div class="font-bold">{{ $sponsor->type }}</div>
                                @if ($sponsor->type == 'sponsor')
                                    <div class="mt-1">{{ $sponsor->sponsor_category }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $sponsor->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-2">
                                <a class="hover:text-orange-400 mr-2" href="{{ route('sponsor.edit', $sponsor) }}"><i
                                        class="fas fw-fw fa-edit"></i></a>
                                <form action="{{ route('sponsor.destroy', $sponsor) }}" method="POST"
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
        {{ $sponsors->links() }}
    </div>

    <a href="{{ route('sponsor.create') }}"
        class="h-14 w-14 flex justify-center items-center absolute bottom-8 right-8 bg-orange-400 rounded-full text-white hover:bg-orange-600"><i
            class="fas fa-fw fa-add"></i></a>

@endsection
