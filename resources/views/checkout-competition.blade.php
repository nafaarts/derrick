@extends('_layouts.main')

@section('title', 'Checkout | ' . $registrant->competition->name)

@section('body')
    @include('components.label', ['label' => 'Checkout'])
    <div class="derrick-container flex flex-col md:flex-row gap-5 p-5">
        <div class="w-full md:w-2/3 p-3">
            <h5 class="text-base mb-2 font-light tracking-wide">#{{ $registrant->registration_number }}</h5>
            <h2 class="text-2xl md:text-3xl font-bold text-SECONDARY tracking-wide">Registration Fee Details</h2>
            <hr class="border-TERTIARY my-5">
            <div class="flex justify-between flex-wrap">
                <div class="w-2/3 mb-3">
                    <p class="text-sm md:text-lg">{{ $registrant->competition->name }}
                        ({{ $registrant->competition->getRegistrationStatus('detail') }} )</p>
                    <small class="text-gray-400">Holder: {{ $registrant->user->name }}</small>
                </div>
                <div class="w-1/3 mb-2 text-right text-sm md:text-lg">Rp.
                    {{ number_format($registrant->competition->getCurrentPrice()) }}
                </div>
                <div class="w-2/3 mb-2 text-sm md:text-lg">Admin Fee</div>
                <div class="w-1/3 mb-2 text-right text-sm md:text-lg text-green-700">+Rp.
                    {{ number_format(6000) }}
                </div>
                <div class="w-2/3 mb-2 text-sm md:text-lg">Total</div>
                <div class="w-1/3 mb-2 text-right text-sm md:text-lg font-bold">Rp.
                    {{ number_format($registrant->competition->getCurrentPrice() + 6000) }}
                </div>
            </div>
            <hr class="border-TERTIARY my-5">
            {{ $responseArray['reference'] }}
            <button id="pay-button"
                class="py-2 px-6 bg-SECONDARY hover:bg-SECONDARY/80 rounded-md text-white w-full md:w-fit float-right"><i
                    class="fas fa-badge-check"></i> Pay Now</button>
        </div>
        <div class="w-full md:w-1/3 p-3">
            <div class="w-full border border-TERTIARY rounded-md text-center p-10 bg-white/50 hidden md:block">
                <img src="{{ asset('storage/competition/logo/' . $registrant->competition->logo) }}" class="mx-auto"
                    alt="competition Logo" width="100">
                <strong
                    class="block mt-5 text-HEADINGTEXT font-bold text-xl">{{ $registrant->competition->name }}</strong><br>
                <small
                    class="font-light">{{ defaultDateFrom($registrant->competition->start_date, $registrant->competition->end_date) }}</small>
            </div>
            <hr class="border-TERTIARY my-5">
            <strong class="block text-HEADINGTEXT font-bold text-2xl">{{ $registrant->competition->name }}</strong>
            <p class="font-light mt-3">{{ $registrant->competition->description }}</p>
        </div>
    </div>

    <form action="{{ route('checkout.callback') }}" method="POST" id="callback-form">
        @csrf
        <input type="hidden" name="callback" id="callback">
    </form>
@endsection

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
        src="{{ env('PAYMENT_IS_PRODUCTION') ? 'https://app-prod.duitku.com/lib/js/duitku.js' : 'https://app-sandbox.duitku.com/lib/js/duitku.js' }}"
        defer></script>

    </script>
    {{-- <script>
        window.jQuery || document.write(
                `<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>`)
    </script> --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            checkout.process("{{ $responseArray['reference'] }}", {
                successEvent: function(result) {
                    send_data(result);
                },
                pendingEvent: function(result) {
                    send_data(result);
                },
                errorEvent: function(result) {
                    alert('Payment Error');
                },
                closeEvent: function(result) {
                    alert('you closed the popup without finishing the payment');
                }
            });
        });

        function send_data(result) {
            document.getElementById('callback').value = JSON.stringify(result);
            document.getElementById('callback-form').submit();
        }
    </script>

@endsection
