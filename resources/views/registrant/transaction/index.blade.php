@extends('admin._layouts.master')

@section('title', 'Transaction')
{{-- 'registrant_id',
        'merchant_order_id',
        'reference',
        'status_code',
        'status_message',
        'amount',
        'fee',
        'payment_code',
        'result_code',
        'response',
        'notification',
        'registration_batch', --}}
@section('body')
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs mb-4">
        <div class="flex items-center justify-between">
            <h2>Transaction Details</h2>
            @if (!$registrant->isPaid())
                <div class="flex items-center gap-2">
                    @if (!in_array($current_transaction->status_message, ['SUCCESS', 'PROCESS']))
                        <a class="text-white bg-yellow-500 py-1 px-2 rounded-md"
                            href="{{ route('competition.checkout') . '?reg=' . $registrant->registration_number }}"><i
                                class="fas fa-fw fa-rotate"></i> retry
                            checkout</a>
                    @else
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
                    {{ $current_transaction->payment_code ? getPaymentCode($current_transaction->payment_code) : '-' }}

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
            {{-- getExpiredTime --}}
            <tr>
                <td class="py-2">Updated At</td>
                <td class="font-bold py-2 pl-12">{{ $current_transaction->updated_at->diffForHumans() }}</td>
            </tr>
            @if (!$registrant->isPaid())
                <tr>
                    <td class="py-2">Expired At</td>
                    <td class="font-bold py-2 pl-12">{{ $current_transaction->getExpiredTime() }}</td>
                </tr>
            @endif
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
            <div class="overflow-x-auto mt-6 rounded-md overflow-hidden mb-3">

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
                                    {{ $transaction->payment_code ? getPaymentCode($transaction->payment_code) : '-' }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <p>{{ $transaction->reference }}</p>
                                    <small>{{ $transaction->status_message }}</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap font-bold uppercase">
                                    {{ $transaction->merchant_order_id }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">IDR {{ number_format($transaction->amount) }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $transaction->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
