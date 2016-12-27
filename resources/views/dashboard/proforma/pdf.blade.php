<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/proforma.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/purecss@0.6.1/build/tables-min.css">

	<title>{{ $proforma->booking_id }} | Print Proforma</title>
</head>
<body>
	<div class="wrapper">

		<div class="date">
			<p>{{ $proforma->created_at }}</p>
		</div>

		<div class="image">
			<img src="{{ asset('images/acikgise-logo.png') }}" style="max-width: 300px; margin: 100px 250px 20px 250px;">
		</div>

		<div class="center">
			<h2>AÇIKGISE BILET HIZMETLERI ve ORGANIZASYON A.S.</h2>
		</div>

		<div class="center">
			<p class="info">Yıldız Posta Caddesi Cerrahoğlu İş Merkezi No:17 Zemin Kat 34394</p>
			<p class="info">Esentepe-Şişli-İSTANBUL</p>
		</div>

		<div class="center">
			<p class="info">Phone: 00 90 212 347 46 30     Fax: 00 90 212 347 46 34</p>
		</div>
		
		<div class="center mt70">
			<h2 class="title">PROFORMA INVOICE</h2>
		</div>

		<div class="center">
			<table class="pure-table pure-table-bordered">
				<tbody>
					<tr>
						<td width="40%">
							<b>TO</b>
						</td>
						<td width="30%">{{ $proforma->customer_name }}</td>
						<td width="30%">{{ $proforma->customer_address }}</td>
					</tr>
					<tr>
						<td width="40%">
							<b>DATE</b>
						</td>
						<td width="30%">
							<b>SERVICE</b>
						</td>
						<td width="30%">
							<b>TOTAL</b>
						</td>
					</tr>
					<tr>
						<td width="40%">
							<p>2017 Turkish Airlines EuroLeague Final Four Istanbul</p>
						</td>
						<td width="30%">
							@foreach ($items as $item)
								<p>{{ $item->area }}</p>
							@endforeach
						</td>
						<td width="30%">
							<p>{{ $proforma->total }} EUR</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="left">
			<p><b>Bank Name:</b> GARANTI BANK</p>
			<p><b>Bank Branch Name:</b> RUMELI CADDESI BRANCH</p>
		</div>
	</div>
</body>
</html>