<style>
    * {
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }

    p {
        font-size: 14px;
        margin-bottom: 4px;
        color: #2E1F2A;
    }

    @page halaman {
        size: A4;
    }

    .page {
        page: halaman;
        width: 90%;
        padding: 5% 5%;
        position: relative;
    }

    table,
    th,
    td {
        /* border: 1px solid #2E1F2A; */
        border-collapse: collapse;
    }

    td {
        padding: 20px;
    }

    table {
        width: 100%;
        border: 1px solid #2E1F2A;
    }

    .header {
        background: #FFEECE;
        color: #2E1F2A;
        border-bottom: 1px solid #2E1F2A;
    }

    small {
        display: inline-block;
        font-weight: lighter;
        margin-bottom: 5px;
        font-size: 10px;
        color: #525252;
    }

    .lighter {
        font-weight: lighter;
    }

    .uppercase {
        text-transform: uppercase;
    }
</style>
<div class="page">
    <table>
        <tr>
            <td class="header">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/logo.png'))) }}"
                    width="30">
            </td>
            <td class="header" style="text-align: center;">
                <h3>DERRICK <span class="lighter">TICKET</span></h3>
            </td>
            <td class="header" style="text-align: right">
                <small>REG NO.</small>
                <h5>{{ $register->registration_number }}</h5>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 30px 20px;">
                <div>
                    <small>COMPETITION</small>
                    <p>{{ $register->competition->name }}</p>
                    <p>{{ defaultDateFrom($register->competition->start_date, $register->competition->end_date) }}
                    </p>
                </div>
                <div style="margin-top: 20px">
                    <small>TYPE & PRICE</small>
                    <p>{{ $latest_transaction->registration_batch }} - IDR
                        {{ number_format($latest_transaction->amount) }}</p>
                </div>
            </td>
            <td>
                <div>
                    <div>
                        <small>ORDER NO</small>
                        <p>{{ $latest_transaction->merchant_order_id }}</p>
                    </div>
                    <div style="margin-top: 20px">
                        <small>PAYMENT STATUS</small>
                        <p class="uppercase">{{ $latest_transaction->status_message }} /
                            {{ $latest_transaction->payment_code ? getPaymentCode($latest_transaction->payment_code) : '-' }}
                        </p>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <small>TICKET HOLDER</small>
                <p>{{ $register->user->name }}</p>
            </td>
            <td>
                <small>ORDER DATE</small>
                <p>{{ date('F d, Y', strtotime($latest_transaction->updated_at)) }}</p>
            </td>

            <td style="text-align: right">
                <img src="data:image/svg+xml;base64,{{ base64_encode($qr) }}" width="60" height="60" />
            </td>
        </tr>
    </table>
    <hr style="border: 1px dotted black; margin: 40px 0">
    <div>
        <h4>Dear Guest,</h4>
        <p style="margin-top: 10px; text-align: justify">This is your event ticket. Ticket holder must present their
            tickets on entry.
            you can either print your
            ticket or present this digital version. You can find all the details about our event on our website. If
            you
            have any questions, issues or wish to get a refund. Please contact the event host. If you can't attend
            the
            event, please get in touch. Looking forward to see you at the event.
        </p>
    </div>
</div>
