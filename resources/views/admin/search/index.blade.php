@extends('admin._layouts.master')

@section('title', request('q') ? 'Search Results for ' . request('q') : 'Search')

@section('head')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection

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
                @if ($registers->isPaid())
                    <a target="_black" href="{{ route('registrant.ticket', $registers->user_id) }}"
                        class="text-SECONDARY hover:text-SECONDARY/80"><i class="fas fa-fw fa-ticket"></i> Competition
                        Ticket</a>
                @endif
                <hr class="border-TERTIARY my-3">
                <p class="italic text-gray-400">Team : {{ $registers->team_name }}</p>
                <div class="flex items-center mt-4 ml-1">
                    <div class="h-8 w-8 rounded-full bg-gray-400 shadow-sm overflow-hidden -ml-1">
                        <img src="{{ asset($registers->user->profile_image ? 'storage/profile/' . $registers->user->profile_image : 'img/sample.png') }}"
                            class="w-8" alt="members">
                    </div>
                    @foreach ($registers->members as $member)
                        <div class="h-8 w-8 rounded-full bg-gray-400 shadow-sm overflow-hidden -ml-1">
                            <img src="{{ asset('storage/competition/registrant/photo/' . $member->photo) }}"
                                class="w-8" alt="members">
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="bg-PRIMARY p-4 md:p-8 rounded-md mb-4">
            <div class="flex justify-between">
                <h5 class="text-xs text-gray-500">Leader Profile:</h5>
            </div>
            <hr class="my-3 border-TERTIARY">
            <div class="flex flex-col md:flex-row items-start gap-0 md:gap-8 mb-8">
                <img src="{{ asset($registers->user->profile_image ? 'storage/profile/' . $registers->user->profile_image : 'img/sample.png') }}"
                    class="w-24 h-full rounded-lg mb-4 md:mb-0" alt="Leader's Photo">
                <table class="text-xs text-gray-500">
                    <tr>
                        <td>Name</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ $registers->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="px-2 py-1">:</td>
                        <td class="font-bold">{{ $registers->user->email }}</td>
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
            <div class="flex justify-between">
                <h5 class="text-xs text-gray-500">Members:</h5>
            </div>
            <hr class="my-3 border-TERTIARY">
            <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3 text-xs">
                <table class="table-auto border-collapse w-full">
                    <thead>
                        <tr class="rounded-lg font-medium text-gray-700 text-left">
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Photo</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Name</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Phone</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Major</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">ID Card</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Student Card</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($registers->members as $person)
                            <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/competition/registrant/photo/' . $person->photo) }}"
                                        class="w-20 rounded-full" alt="">
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <p class="font-bold">{{ $person->name }}</p>
                                    <p>{{ $person->email }}</p>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $person->phone_number }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $person->major }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <a class="text-SECONDARY hover:text-SECONDARY/80"
                                        href="{{ asset('storage/competition/registrant/id_card/' . $person->id_card) }}"
                                        target="_blank">preview <i class="fas fa-fw fa-link"></i></a>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <a class="text-SECONDARY hover:text-SECONDARY/80"
                                        href="{{ asset('storage/competition/registrant/student_card/' . $person->student_card) }}"
                                        target="_blank">preview <i class="fas fa-fw fa-link"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($registers->transactions->count() > 0)
            <div class="bg-PRIMARY p-4 rounded-md w-full text-xs mb-4">
                <div class="flex items-center justify-between">
                    <h2>Transaction Details</h2>
                    @if (!$registers->isPaid())
                        <div class="flex items-center gap-2">
                            @if (in_array($current_transaction->status_message, ['SUCCESS', 'PROCESS']))
                                <a class="py-1 px-2 bg-green-500 text-white rounded-md animate-pulse"
                                    href="{{ route('checkout.check') . '?order_id=' . $current_transaction->merchant_order_id }} "><i
                                        class="fas fa-fw fa-refresh"></i> check transaction</a>
                            @endif
                        </div>
                    @endif
                </div>
                <hr class="my-3 border-TERTIARY">
                <table>
                    <tr>
                        <td class="py-2">Transaction ID</td>
                        <td class="font-bold py-2 pl-12">{{ $current_transaction->reference }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">Order ID</td>
                        <td class="font-bold py-2 pl-12">{{ $current_transaction->merchant_order_id }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">Payment Type</td>
                        <td class="font-bold py-2 pl-12 uppercase">
                            {{ $current_transaction->payment_code ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2">Message</td>
                        <td class="font-bold py-2 pl-12">"{{ $current_transaction->status_message }}"</td>
                    </tr>
                    <tr>
                        <td class="py-2">Pay Amount</td>
                        <td class="font-bold py-2 pl-12">IDR {{ number_format($current_transaction->amount) }}</td>
                    </tr>
                    @can('isAdmin')
                        <tr>
                            <td class="py-2">Response</td>
                            <td class="text-xs font-light italic py-2 pl-12">
                                <code>
                                    {{ $current_transaction->response }}
                                </code>
                            </td>
                        </tr>
                    @endcan
                </table>
            </div>

            @if ($other_transaction)
                <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
                    <h2>Transaction History</h2>
                    <hr class="my-3 border-TERTIARY">
                    <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3 text-xs">
                        <table class="table-auto border-collapse w-full">
                            <thead>
                                <tr class="rounded-lg font-medium text-gray-700 text-left">
                                    <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Type</th>
                                    <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Transaction ID</th>
                                    <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Order Id</th>
                                    <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Amount</th>
                                    <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Time</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach ($other_transaction as $transaction)
                                    <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $transaction->payment_code ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <p>{{ $transaction->reference }}</p>
                                            <small>{{ $transaction->status_message }}</small>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap font-bold uppercase">
                                            {{ $transaction->merchant_order_id }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap">IDR
                                            {{ number_format($transaction->amount) }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $transaction->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    @else
        <div class="flex items-center bg-PRIMARY text-gray-500 rounded-md">
            <lottie-player src="{{ asset('lf30_editor_gpdl1oqd.json') }}" background="transparent" speed="1"
                style="width: 200px; height: 200px;" autoplay loop></lottie-player>
            <div class="">
                <h1 class="text-lg text-SECONDARY mb-1 font-bold">No registrant found !</h1>
                <p class="text-xs mb-2">Please check registration number again!</p>
                <small class="font-light"><i>query : <strong>{{ request('q') }}</strong></i></small>
            </div>
        </div>
    @endif

@endsection
