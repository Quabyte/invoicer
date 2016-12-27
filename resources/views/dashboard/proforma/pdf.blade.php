<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/print.css') }}">

	<title>{{ $proforma->booking_id }} | Print Proforma</title>
</head>
<body>
	<div class="invoicePage">
		
		<div class="upperArea">
			<div class="invoiceAdress">
				<p>{{ $proforma->customer_name }}</p>
				<p>{{ $proforma->customer_address }}</p>
			</div>
			<div class="invoiceDate">
				<p>{{ $proforma->created_at }}</p>
			</div>
		</div>

		<div class="midArea">
			<div class="invoiceExplanation">

				<div style="padding-left: 50px;">
					@foreach ($items as $item)
						<p>1 x {{ $item->area }} TICKET</p>
					@endforeach
				</div>
				
				<p style="margin-left: 424px; float: right; position: relative;">{{ $proforma->total }} EUR</p>
			</div>
		</div>

		<div class="bottomArea">
			<div class="invoiceTotal">
				<p>{{ $proforma->total }} EUR</p>
			</div>
		</div>

	</div>
</body>
</html>