<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ public_path('css/main.css') }}">

    <style>
        .page {
            height: 297mm;
            width: 210mm;
            page-break-after: always;
        }

        .c-table {
            border: none !important;
        }

        .c-table__row {
            border: none;
        }

        .c-table__head {
            border-bottom: 1px solid #333333;
        }

        .c-table__cell--head {
            color: #333333;
        }

        .c-table__cell {
            padding: 10px 0 10px 10px;
            font-size: 12px !important;
        }

        .u-bg-success {
            background-color: #4DB666 !important;
        }

        .u-color-success {
            color: #4DB666 !important;
        }

        .u-color-info {
            color: #3E7EB8 !important;
        }
    </style>
</head>

<body class="u-bg-white">
    <div class="page" style="">
        <img class="pull-right"
             src="{{ public_path('/img/quincomm-logo.png') }}"
        >

        <div class="u-width-100"
             style="position: absolute; top: 35%"
        >
            <div class="row">
                <div class="col-12">
                    <h1>
                        Mobile Telephony Proposal
                    </h1>

                    <h4>
                        {{ title_case($proposal->opportunity->lead->review->prospect->company_name) }}
                    </h4>
                </div>
            </div>
        </div>


        <div class="u-width-100"
             style="position: absolute; bottom: 0"
        >
            <div class="row u-mb-medium">
                <div class="col-6">
                    <p>Prepared For</p>

                    <h5>
                        {{ title_case($proposal->contact->name) }}
                    </h5>
                </div>

                <div class="col-6">
                    <p>Prepared on</p>

                    <h5>
                        {{ \Carbon\Carbon::now()->format('d F Y') }}
                    </h5>
                </div>
            </div>

            <div class="row u-mb-medium">
                <div class="col-6">
                    <p>Proposed By</p>

                    <h5>
                        {{ title_case($proposal->opportunity->user->name) }}
                    </h5>
                </div>

                <div class="col-6">
                    <p>Quote Reference</p>

                    <h5>
                        {{ str_limit($prospect->company_name, 5, '') }}{{ $opportunity->id }}-{{ $proposal->id }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page" style="">
        <div class="u-width-100 u-mb-medium">
            <img class="pull-right"
                 src="{{ public_path('/img/quincomm-logo.png') }}"
            >

            <h4 class="u-h3 u-color-info u-pt-small u-text-bold">
                Proposed Solution
            </h4>
        </div>

        <div class="u-width-100 u-bg-success">
            <h4 class="u-text-white u-p-xsmall">Airtime</h4>
        </div>

        <b class="u-text-bold">
            Powered by the O2 network
        </b>

        <table class="c-table">
            <thead class="c-table__head">
                <tr class="c-table__row">
                    <th class="c-table__cell c-table__cell--head">Tariff</th>
                    <th class="c-table__cell c-table__cell--head">Plan</th>
                    <th class="c-table__cell c-table__cell--head">Term</th>
                    <th class="c-table__cell c-table__cell--head">Quantity</th>
                    <th class="c-table__cell c-table__cell--head">Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach($proposal->airtime as $airtime)
                    <tr class="c-table__row">
                        <td class="c-table__cell">
                            {{ $airtime->tariff }}
                        </td>

                        <td class="c-table__cell">
                            {{ $airtime->minutes }} minutes
                            {{ $airtime->texts }} texts
                            {{ $airtime->data }} data
                        </td>

                        <td class="c-table__cell u-width-15">
                            {{ $airtime->term }}
                        </td>

                        <td class="c-table__cell u-width-15">
                            {{ $airtime->quantity }}
                        </td>

                        <td class="c-table__cell u-width-15">
                            {{ number_format($airtime->price, 2) }}
                        </td>

                    </tr>
                @endforeach

                <tr class="c-table__row">
                    <td class="c-table__cell"></td>
                    <td class="c-table__cell"></td>
                    <td class="c-table__cell"></td>
                    <td class="c-table__cell">
                        <strong>
                            Monthly Cost
                        </strong>
                    </td>

                    <td class="c-table__cell">
                        <strong>
                            £{{ number_format($proposal->airtime->sum(function($item){ return $item->price * $item->quantity; }), 2) }}
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="u-mb-xsmall" style="font-size: 10px;">
            Monthly cost quoted is based on airtime subscription with a payment method of Direct Debit made directly
            to EE.
        </p>


        @if($proposal->hardware->count() > 0)
            <b class="u-text-bold">
                Credits
            </b>

            <table class="c-table">
                <thead class="c-table__head">
                    <tr class="c-table__row">
                        <th class="c-table__cell c-table__cell--head">Type</th>
                        <th class="c-table__cell c-table__cell--head">Description</th>
                        <th class="c-table__cell c-table__cell--head">Quantity</th>
                        <th class="c-table__cell c-table__cell--head">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($proposal->credits as $credit)
                        <tr class="c-table__row">
                            <td class="c-table__cell">
                                {{ $credit->type }}
                            </td>

                            <td class="c-table__cell">
                                {{ $credit->description }}
                            </td>

                            <td class="c-table__cell u-width-15">
                                {{ $credit->quantity }}
                            </td>

                            <td class="c-table__cell u-width-15">
                                {{ $credit->price }}
                            </td>
                        </tr>
                    @endforeach

                    <tr class="c-table__row">
                        <td class="c-table__cell"></td>
                        <td class="c-table__cell"></td>
                        <td class="c-table__cell">
                            <strong>
                                Total Credits
                            </strong>
                        </td>

                        <td class="c-table__cell">
                            <strong>
                                £{{ number_format($proposal->airtime->sum(function($item){ return $item->price * $item->quantity; }), 2) }}
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif

        @if($proposal->hardware->count() > 0)
            <div class="u-width-100 u-bg-success">
                <h4 class="u-text-white u-p-xsmall">Hardware</h4>
            </div>

            <table class="c-table">
                <thead class="c-table__head">
                    <tr class="c-table__row">
                        <th class="c-table__cell c-table__cell--head">Manufacturer</th>
                        <th class="c-table__cell c-table__cell--head">Model</th>
                        <th class="c-table__cell c-table__cell--head">Quantity</th>
                        <th class="c-table__cell c-table__cell--head">Upfront</th>
                        <th class="c-table__cell c-table__cell--head">Monthly</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($proposal->hardware as $hardware)
                        <tr class="c-table__row">
                            <td class="c-table__cell">
                                {{ $hardware->manufacturer }}
                            </td>

                            <td class="c-table__cell">
                                {{ $hardware->model }}
                            </td>

                            <td class="c-table__cell u-width-15">
                                {{ $hardware->quantity }}
                            </td>

                            <td class="c-table__cell u-width-15">
                                {{ number_format($hardware->upfront, 2) }}
                            </td>

                            <td class="c-table__cell u-width-15">
                                {{ number_format($hardware->monthly, 2) }}
                            </td>
                        </tr>
                    @endforeach

                    <tr class="c-table__row">
                        <td class="c-table__cell"></td>
                        <td class="c-table__cell"></td>
                        <td class="c-table__cell">
                            <strong>
                                Total
                            </strong>
                        </td>
                        <td class="c-table__cell">
                            <strong>
                                £{{ number_format($proposal->hardware->sum(function($item){ return $item->upfront * $item->quantity; }), 2) }}
                            </strong>
                        </td>
                        <td class="c-table__cell">
                            <strong>
                                £{{ number_format($proposal->hardware->sum(function($item){ return $item->monthly * $item->quantity; }), 2) }}
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p style="font-size: 10px;">
                Monthly cost is based on hardware leased through our partner Tower Leasing, paid by Direct Debit.
            </p>
        @endif

        <div class="u-width-100 u-bg-success u-mt-small">
            <h4 class="u-text-white u-p-xsmall">Total Cost</h4>
        </div>

        <table class="c-table">
            <thead class="c-table__head">
                <tr class="c-table__row">
                    <th class="c-table__cell c-table__cell--head">Product</th>
                    <th class="c-table__cell c-table__cell--head">Term</th>
                    <th class="c-table__cell c-table__cell--head">Upfront</th>
                    <th class="c-table__cell c-table__cell--head">Monthly</th>
                </tr>
            </thead>

            <tbody>
                @foreach($proposal->totals as $total)
                    <tr class="c-table__row">
                        <td class="c-table__cell">
                            {{ $total->product }}
                        </td>

                        <td class="c-table__cell u-width-15">
                            {{ $total->term }}
                        </td>

                        <td class="c-table__cell u-width-15">
                            {{ number_format($total->upfront, 2) }}
                        </td>

                        <td class="c-table__cell u-width-15">
                            {{ number_format($total->monthly, 2) }}
                        </td>
                    </tr>
                @endforeach

                <tr class="c-table__row">
                    <td class="c-table__cell"></td>
                    <td class="c-table__cell">
                        <strong>
                            Total Cost
                        </strong>
                    </td>
                    <td class="c-table__cell">
                        <strong>
                            £{{ number_format($proposal->totals->sum('upfront'), 2) }}
                        </strong>
                    </td>
                    <td class="c-table__cell">
                        <strong>
                            £{{ number_format($proposal->totals->sum('monthly'), 2) }}
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="page" style="">
        <p class="u-width-100 u-mb-medium">
            <img class="pull-right"
                 src="{{ public_path('/img/quincomm-logo.png') }}"
            >

        <h4 class="u-h3 u-color-info u-pt-small u-text-bold u-mb-xlarge">
            Testimonials
        </h4>

        <div class="u-mb-large">
            <h3 class="u-h4 u-color-success">“Customer service is brilliant!”</h3>

            <p class="u-text-large u-mb-xsmall">
                Spot on, I’m happy with everything, no fuss, they keep their promises and customer service is brilliant!
            </p>

            <p class="u-text-right u-text-large">Will Alderson</p>
        </div>

        <div class="u-mb-large">
            <h3 class="u-h4 u-color-success">“More than happy to recommend them to any other business”</h3>

            <p class="u-text-large u-mb-xsmall">
                Quincomm got me on to a better contract for my company’s mobile telecoms. The whole process was fully
                explained to me at every stage, promptly and fully… I am more than happy to recommend them to any other
                business.
            </p>

            <p class="u-text-right u-text-large">Dean Rae</p>
        </div>

        <div class="u-mb-large">
            <h3 class="u-h4 u-color-success">“They simply do everything they say they will”</h3>

            <p class="u-text-large u-mb-xsmall">
                Friendly, helpful staff, straight forward, easy to understand deals. Promises kept and delivered, they
                simply do everything they say they will and customer services are excellent.
            </p>

            <p class="u-text-right u-text-large">Peter Baggs</p>
        </div>

        <div class="u-mb-large">
            <h3 class="u-h4 u-color-success">“No issues whatsoever”</h3>

            <p class="u-text-large u-mb-xsmall">
                Most important thing for me was the easy transition to my new contract, no bother and all worked
                straight
                away. I have no issues whatsoever and they did me a very good deal.
            </p>

            <p class="u-text-right u-text-large">Christopher Carter</p>
        </div>

        <div class="u-mb-large">
            <h3 class="u-h4 u-color-success">“Highly recommended”</h3>

            <p class="u-text-large u-mb-xsmall">
                Staff were great, had my phone and new SIM sent out quickly and have done nothing but assist me with
                anything I’ve needed since. Highly recommended.
            </p>

            <p class="u-text-right u-text-large">Andrea Nixon</p>
        </div>

    </div>
</body>
</html>
