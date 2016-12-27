<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/print.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

	<title>{{ $proforma->booking_id }} | Print Proforma</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-4"></div>
			<div class="col-md-4">
				<img src="{{ asset('images/acikgise-logo.png') }}">
			</div>
			<div class="col-md-4">
				<p>{{ $proforma->created_at }}</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-2">
				
			</div>
			<div class="col-md-8">
				<h2>AÇIKGİŞE BİLET HİZMETLERİ ve ORGANİZASYON A.Ş.</h2>
				<p>Yıldız Posta Caddesi Cerrahoğlu İş Merkezi No:17 Zemin Kat 34394</p>
				<p>Esentepe-Şişli-İSTANBUL</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-2"></div>
			<div class="col-md-8">
				<p>Phone: 00 90 212 347 46 30 Fax: 00 90 212 347 46 34</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-4"></div>
			<div class="col-md-4">
				<h2>PROFORMA INVOICE</h2>
			</div>
		</div>

		<div class="row">
			<table class="table">
				<tbody>
					<tr>
						<td>TO</td>
						<td>{{ $proforma->customer_name }}</td>
						<td>{{ $proforma->customer_address }}</td>
					</tr>
					<tr>
						<td>DATE</td>
						<td>SERVICE</td>
						<td>TOTAL</td>
					</tr>
					<tr>
						<td>
							<p>2017 Turkish Airlines EuroLeague Final Four Istanbul</p>
						</td>
						<td>
							<p>{{}}</p>
						</td>
						<td>
							<p>{{ $proforma->total }}</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	{{-- <div class="invoicePage">
		
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

	</div> --}}
</body>
</html>