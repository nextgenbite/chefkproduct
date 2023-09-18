<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVOICE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
        @page {
			margin: 0;
			padding:0;
		}
		body{
			font-size: 0.875rem;
            font-family: 'my_custom_name','Times New Roman', Times, serif;
            font-weight: normal;
            direction: ltr;
            text-align: left;
			padding:0;
			margin:0;
		}
		.gry-color *,
		.gry-color{
			color:#000;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .25rem .7rem;
		}
		table.padding td{
			padding: .25rem .7rem;
		}
		table.sm-padding td{
			padding: .1rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align: right;
		}
	</style>
</head>
<body>
	<div>
        @php
        $settings= App\Models\SiteSetting::firstOrFail();
         @endphp
		<div style="background: #eceff4;padding: 1rem;">
			<table>
				<tr>
					<td>
						@if($settings->logo != null)
                        <img src="{{asset('/storage/'.$settings->logo)}}" alt="{{asset('/storage/'.$settings->logo)}}" height="30" style="display:inline-block;">
                        @else
							<img src="https://s3.eu-central-1.amazonaws.com/zl-clients-sharings/90Tech.png" height="30" style="display:inline-block;">
						@endif
					</td>
					<td style="font-size: 1.5rem;" class="text-right strong">INVOICE</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="font-size: 1rem;" class="strong">{{ $settings->app_name }}</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">{{  $settings->address }}</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small"> Email: {{ $settings->email }}</td>
					<td class="text-right small"><span class="gry-color small">Order ID:</span> <span class="strong">{{ $order->code }}</span></td>
				</tr>
				<tr>
					<td class="gry-color small"> Phone: {{  $settings->phone }}</td>
					<td class="text-right small"><span class="gry-color small"> Order Date:</span> <span class=" strong">{{  $order->order_date }}</span></td>
				</tr>
				<tr>
					<td class="gry-color small"></td>
					<td class="text-right small">
                        <span class="gry-color small">
                            Payment method:
                        </span>
                        <span class="strong">
                            home_delivery
                        </span>
                    </td>
				</tr>
			</table>

		</div>

		<div style="padding: 1rem;padding-bottom: 0">
            <table>
				<tr><td class="strong small gry-color">Bill to:</td></tr>
				<tr><td class="strong">{{ $order->name }}</td></tr>
				<tr><td class="gry-color small">{{ $order->address }}, {{ $order->city }},  {{ $order->state }} </td></tr>
				<tr><td class="gry-color small">Phone: {{ $order->phone }}</td></tr>
			</table>
		</div>

	    <div style="padding: 1rem;">
			<table class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%" class="text-left">Product Name</th>
						{{-- <th width="15%" class="text-left">Delivery Type</th> --}}
	                    <th width="10%" class="text-left">Qty</th>
	                    <th width="15%" class="text-left">Unit Price</th>
	                    {{-- <th width="10%" class="text-left">Tax</th> --}}
	                    <th width="15%" class="text-right">Total</th>
	                </tr>
				</thead>
				<tbody class="strong">
	                @foreach ($order->orderitem as $key => $orderDetail)
		                @if ($orderDetail->product != null)
							<tr class="">
								<td>
                                    {{ $orderDetail->product->title }}
                                    {{-- @if($orderDetail->variation != null) ({{ $orderDetail->variation }}) @endif
                                    <br>
                                    <small>
                                        @php
                                            $product_stock = json_decode($orderDetail->product->stocks->first(), true);
                                        @endphp
                                        {{translate('SKU')}}: {{ $product_stock['sku'] }}
                                    </small> --}}
                                </td>
								{{-- <td>
									@if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
										{{ translate('Home Delivery') }}
									@elseif ($order->shipping_type == 'pickup_point')
										@if ($order->pickup_point != null)
											{{ $order->pickup_point->getTranslation('name') }} ({{ translate('Pickip Point') }})
										@else
                                            {{ translate('Pickup Point') }}
										@endif
									@elseif ($order->shipping_type == 'carrier')
										@if ($order->carrier != null)
											{{ $order->carrier->name }} ({{ translate('Carrier') }})
											<br>
											{{ translate('Transit Time').' - '.$order->carrier->transit_time }}
										@else
											{{ translate('Carrier') }}
										@endif
									@endif
								</td> --}}
								<td class="">{{ $orderDetail->qty }}</td>
								<td class="currency">{{ $orderDetail->total/$orderDetail->qty }}</td>
								{{-- <td class="currency">{{ single_price($orderDetail->tax/$orderDetail->quantity) }}</td> --}}
			                    <td class="text-right currency">{{ $orderDetail->total }}</td>
							</tr>
		                @endif
					@endforeach
	            </tbody>
			</table>
		</div>

	    <div style="padding:0 1.5rem;">
	        <table class="text-right sm-padding small strong">
	        	<thead>
	        		<tr>
	        			<th width="60%"></th>
	        			<th width="40%"></th>
	        		</tr>
	        	</thead>
		        <tbody>
			        <tr>
			            <td class="text-left">
                            @php
                                $removedXML = '<?xml version="1.0" encoding="UTF-8"?>';
                            @endphp
                            {!! str_replace($removedXML,"", SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($order->code)) !!}
			            </td>
			            <td>
					        <table class="text-right sm-padding small strong">
						        <tbody>
							        <tr>
							            <th class="gry-color text-left">Sub Total</th>
							            <td class="currency">{{ $order->total }}</td>
							        </tr>
							        <tr>
							            <th class="gry-color text-left">Shipping Cost</th>
							            <td class="currency">{{ $order->shipping_cost }}</td>
							        </tr>
							        {{-- <tr class="border-bottom">
							            <th class="gry-color text-left">Total Tax</th>
							            <td class="currency">{{ single_price($order->orderDetails->sum('tax')) }}</td>
							        </tr> --}}
				                    <tr class="border-bottom">
							            <th class="gry-color text-left">Coupon Discount</th>
							            <td class="currency">{{ $order->coupon }}</td>
							        </tr>
							        <tr>
							            <th class="text-left strong">Grand Total</th>
							            <td class="currency">{{ $order->total+$order->shipping_cost }}</td>
							        </tr>
						        </tbody>
						    </table>
			            </td>
			        </tr>
		        </tbody>
		    </table>
	    </div>

	</div>
</body>
</html>
