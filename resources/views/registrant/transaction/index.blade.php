@extends('admin._layouts.master')

@section('title', 'Transaction')

@section('body')
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs mb-4">
        <h2>Transaction Details</h2>
        <hr class="my-3 border-TERTIARY">
        <table>
            <tr>
                <td class="py-2">Transaction ID</td>
                <td class="font-bold py-2 pl-12">{{ $current_transaction->transaction_id }}</td>
            </tr>
            <tr>
                <td class="py-2">Order ID</td>
                <td class="font-bold py-2 pl-12">{{ $current_transaction->order_id }}</td>
            </tr>
            <tr>
                <td class="py-2">Payment Type</td>
                <td class="font-bold py-2 pl-12 uppercase">
                    {{ $current_transaction->payment_type == 'cstore' ? 'Alfamart / Indomaret' : $current_transaction->payment_type }}
                </td>
            </tr>
            <tr>
                <td class="py-2">Transaction Time</td>
                <td class="font-bold py-2 pl-12">{{ $current_transaction->transaction_time }}</td>
            </tr>
            <tr>
                <td class="py-2">Transaction Status</td>
                <td class="font-bold py-2 pl-12 uppercase">
                    @if ($registrant->isPaid())
                        <span class="text-green-500 font-bold rounded-md">
                            <i class="fas fa-fw fa-check"></i>
                            {{ $current_transaction->transaction_status ?? '' }}
                        </span>
                    @elseif($current_transaction->transaction_status == 'pending')
                        <span class="text-yellow-500 font-bold rounded-md">
                            <i class="fas fa-fw fa-hourglass"></i>
                            {{ $current_transaction->transaction_status ?? '' }}
                        </span>
                    @else
                        <span class="text-red-500 font-bold rounded-md">
                            <i class="fas fa-fw fa-times"></i>
                            {{ $current_transaction->transaction_status ?? '' }}
                        </span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="py-2">Message</td>
                <td class="font-bold py-2 pl-12">"{{ $current_transaction->status_message }}"</td>
            </tr>
            <tr>
                <td class="py-2">Pay Amount</td>
                <td class="font-bold py-2 pl-12">IDR {{ number_format($current_transaction->gross_amount) }}</td>
            </tr>
            @if ($current_transaction->pdf_url)
                <tr>
                    <td class="py-2">Transaction Guide</td>
                    <td class="font-bold py-2 pl-12">
                        <a href="{{ $current_transaction->pdf_url }}" target="_blank"
                            class="text-SECONDARY hover:text-SECONDARY/80">
                            download <i class="fas fa-fw fa-link"></i>
                        </a>
                    </td>
                </tr>
            @endif
            @if (!$registrant->isPaid())
                <tr>
                    <td rowspan="2" class="font-bold py-2 pt-10">
                        <a class="text-SECONDARY hover:text-SECONDARY/80"
                            href="{{ route('competition.checkout') . '?reg=' . $registrant->registration_number }}"><i
                                class="fas fa-fw fa-rotate"></i> retry
                            checkout</a>
                    </td>
                </tr>
            @endif
        </table>
    </div>

    @if ($other_transaction)
        <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
            <h2>Transaction History</h2>
            <hr class="my-3 border-TERTIARY">
            <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3">

                <table class="table-auto border-collapse w-full">
                    <thead>
                        <tr class="rounded-lg font-medium text-gray-700 text-left">
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Transaction ID</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Status</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Type</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Amount</th>
                            <th class="px-4 py-4 bg-TERTIARY whitespace-nowrap">Time</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($other_transaction as $transaction)
                            <tr class="hover:bg-TERTIARY border-b border-TERTIARY py-5">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <p>{{ $transaction->transaction_id }}</p>
                                    <small>{{ $transaction->status_message }}</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap font-bold uppercase">
                                    {{ $transaction->transaction_status }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{ $transaction->payment_type == 'cstore' ? 'Alfamart / Indomaret' : $transaction->payment_type }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $transaction->gross_amount }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $transaction->transaction_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
