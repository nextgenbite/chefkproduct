<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        * {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            vertical-align: baseline;
            min-height: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        body {
            font-size: 14px;
            font-family: DejaVu Sans, sans-serif;
            font-weight: 400;
            color: #444;
        }

        h1, h2, h3, h4, h5, h6, p, ul, span, li, input, button {
            margin: 0;
            padding: 0;
            line-height: 1.4;
            box-sizing: border-box;
        }

        span {
            font-family: DejaVu Sans, sans-serif;
            line-height: inherit;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: inherit;
        }

        p {
            line-height: 1.8;
            font-size: 1em;
            font-weight: 400;
            color: #112211;
        }

        h1 {
            font-size: 3.5em;
        }

        h2 {
            font-size: 2.5em;
        }

        h3 {
            font-size: 1.8em;
        }

        h4 {
            font-size: 1.3em;
        }

        h5 {
            font-size: 1.1em;
        }

        h6 {
            font-size: .95em;
            letter-spacing: 1px;
            line-height: 1.6;
        }

        strong {
            font-weight: 700;
        }

        img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        li {
            display: block;
            list-style: none;
            font-size: 1em;
        }

        i, span {
            display: inline-block;
        }

        b {
            display: inline-block;
            font-weight: 500;
        }

        .p-30 {
            padding: 30px;
        }


        table {
            width: 100%;
            font-family: inherit;
        }

        table tr {
            vertical-align: top;
        }

        table td {
            font-family: inherit;
        }

        table th {
            font-family: inherit;
            text-align: left;
        }

        .table-c tr th {
            background: {{ $settings['color'] ?? '#486FF0' }};
            color: #fff;
            text-align: left;
            font-size: .9em;
            font-weight: 400;
            padding: 10px;
        }

        .border-tr tr td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .border-tr tr:last-child td {
            border-bottom: none;
        }

        .table-c tr td {
            padding: 5px 10px;
        }

        .td-right-align tr td, .td-right-align tr th {
            text-align: right;
            padding: 5px 0;
        }

        .main-table tr td{
            padding: 15px 10px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mb-5 {
            margin-bottom: 5px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .ml-10 {
            margin-left: 10px;
        }

        .block {
            display: block;
        }

        .mt-5 {
            margin-top: 5px;
        }

        .f-9{
            font-size: .9em;
            color: #666
        }
        .store_name{
            text-transform: capitalize
        }
        .qrcode svg{
            max-width: 20px;
            text-align: left
        }
        .text-left{
			text-align:left;
		}
		.text-right{
			text-align: right;
		}
        
    </style>
</head>
<body style="padding: 30px;">
<table class="mb-20">
    <tr>
        <td>
            <div style="max-width: 350px;">
                <img style="height: 40px; width: auto; margin-bottom: 10px"
                     src="{{ asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}">
                <h4 class="mt-10 mb-10 store_name">{{ isset($settings['app_name']) ? $settings['app_name'] : 'Nextgenbite' }}</h4>
                <p> {{isset($settings['address']) ? $settings['address'] : ''}}</p>
                <p>{{__('lang.phone')}}: {{isset($settings['phone']) ? $settings['phone'] : '01715808563' }}</p>
            </div>
        </td>
        <td>
            <h3 class="mb-10 ml-10">Invoice</h3>
            <table style="max-width: 400px;">
                <tr>
                    <td>{{__('lang.order')}}</td>
                    <td>#{{ $order->code }}</td>
                </tr>
                <tr>
                    <td>{{__('lang.order_date')}}</td>
                    <td>{{ $order->order_date }}</td>
                </tr>
                <tr>
                    <td>{{__('lang.order_amount')}}</td>
                    <td>{{ $order->total+$order->shipping_cost}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table class="mb-20 table-c">
    <tr>
        <th style="text-align: left;">{{__('lang.ship_to')}}</th>
        <th style="text-align: left;">{{__('lang.order_method')}}</th>
    </tr>

    <tr>
        <td style="width: 50%;">
            <div style="max-width: 300px;">
                <h5 class="mb-5">{{ $order->name }}</h5>
                <p>{{__('lang.address')}}:{{  $order->address }}</p>

                @if($order->user)
                    <p>{{__('lang.email')}}: {{ $order->user->email }}</p>
                @endif


                <p>{{__('lang.phone')}}: {{ $order->phone }}</p>
            </div>
        </td>
        <td style="width: 50%;text-transform: capitalize;">{{ $order->payment_method == 'cash_on_delivary' ? 'Cash On Delivery' : $order->payment_method }}</td>
    </tr>
</table><!--table-->

<table class="border-tr table-c main-table">
    <tr>
        <th>{{__('lang.title')}}</th>
        {{-- <th>{{__('lang.delivery_fee')}}</th> --}}
        <th>{{__('lang.quantity')}}</th>
        <th>{{__('lang.price')}}</th>
        <th>{{__('lang.total')}}</th>
    </tr>

    @foreach ($order->orderitem as $item)
        <tr>
            <td>
               {{ $item->product->title }}
                {{-- <span class="mt-5 f-9 block">{{ \App\Models\Helper\MailHelper::generatingAttribute($item) }}</span> --}}
            </td>
            {{-- <td>
                {{ $setting->currency_icon }}
                {{ \App\Models\Helper\MailHelper::shippingPrice($item->shipping_place, $item->shipping_type) }}
            </td> --}}
            <td>{{ $item->qty }}</td>

            <td>{{ formatCurrency($item->total/$item->qty) }}</td>
            <td>{{formatCurrency($item->total) }}</td>
        </tr>

    @endforeach
</table><!--table-->
<div style="padding:0 1.5rem;">
    <table class="text-right sm-padding small strong">
        <thead>
            <tr>
                <th width="60%"></th>
                <th width="40%"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $removedXML = '<?xml version="1.0" encoding="UTF-8"?>';
            // $qrCode = base64_encode(str_replace($removedXML,"", SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(100)->generate($order->code)));
        @endphp
            <tr>
                <td class="text-left">
                    {{-- <div class="qrcode">
                        {!! str_replace($removedXML,"", SimpleSoftwareIO\QrCode\Facades\QrCode::size(40)->generate($order->code)) !!}
                    </div> --}}
                    {{-- {!! QrCode::format('svg')->size(100)->generate($order->code) !!} --}}
                    <img style="width: 100px" src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode($order->code) }}" alt="QR Code">
                    {{-- {!! str_replace($removedXML, "", SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(50)->generate($order->code)) !!} --}}
                </td>
            <td>
                    <table class="text-right sm-padding small strong td-right-align">
                        <tbody>
                           
                            <tr>
                                <th class="gry-color text-left">{{__('lang.subtotal')}}</th>
                                <td class="currency">{{ formatCurrency($order->total) }}</td>
                            </tr>
                            <tr>
                                <th class="gry-color text-left">{{__('lang.shipping_cost')}}</th>
                                <td class="currency">{{ formatCurrency($order->shipping_cost) }}</td>
                            </tr>
                            {{-- <tr class="border-bottom">
                                <th class="gry-color text-left">Total Tax</th>
                                <td class="currency">{{ single_price($order->orderDetails->sum('tax')) }}</td>
                            </tr> --}}
                            <tr class="border-bottom">
                                <th class="gry-color text-left">{{__('lang.discount')}}</th>
                                <td class="currency">{{ formatCurrency($order->coupon) }}</td>
                            </tr>
                            <tr>
                                <th class="text-left strong">{{__('lang.total')}}</th>
                                <td class="currency">{{ formatCurrency($order->total+$order->shipping_cost) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div style="width: 100%; clear: both; display: block; padding-top: 50px;">
    <table class="table-c" style="width: 50%;">
        <tr>
            <th>{{__('lang.notes')}}</th>
        </tr>

        <tr>
            <td style="width: 50%;">
                <p style="margin-bottom: 10px; font-style: italic;">
                    {{__('lang.order_number')}}
                </p>
                <p>
                    {{__('lang.question_str')}}: {{ isset($settings['phone']) ? $settings['phone'] : '01715808563'  }}
                </p>
            </td>
        </tr>
    </table><!--table-->
</div>
</body>
<html>
