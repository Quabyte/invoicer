<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/print.css') }}">

	<title>{{ $invoice->transaction_id }} | Print Invoice</title>
</head>
<body>
	<div class="invoicePage">
		
		<div class="upperArea">
			<div class="invoiceAdress">
				<p>{{ $invoice->customer_name }}</p>
				<p>{{ $invoice->address }}</p>
				<p>{{ $invoice->zip_code }}</p>
				<p>{{ $invoice->province }} / {{ $invoice->country }}</p>
			</div>
			<div class="invoiceDate">
				<p>{{ $invoice->generated }}</p>
			</div>
		</div>

		<div class="midArea">
			<div class="invoiceExplanation">
				<p style="margin-top: 10px;">{{ $invoice->package }}</p>

				<div style="padding-left: 50px;">
					@foreach ($items as $item)
						<p>1 x {{ $item->area }} TICKET</p>
					@endforeach
				</div>
				
				<div style="margin-top: 50px;">
					<p>KDV'li Matrah: {{ App\Invoice::convertToTL($invoice->total - $invoice->tax) }} TL</p>
					<p>KDV % 18: {{ App\Invoice::convertToTL($invoice->tax) }} TL</p>
					<p>GENEL TOPLAM: {{ App\Invoice::convertToTL($invoice->total) }} TL</p>
				</div>
				<p style="margin-left: 424px; float: right; position: relative;">{{ $invoice->total }} EUR</p>
			</div>
		</div>

		<div class="bottomArea">
			<div class="invoicePriceText">
				<p class="small">{{ $invoice->price_text }}</p>
			</div>
			<div class="invoiceTotal">
				<p>{{ $invoice->total }} EUR</p>
			</div>
		</div>

	</div>
</body>
</html>