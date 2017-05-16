<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/proforma.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/purecss@0.6.1/build/tables-min.css">

	<title>{{ $proforma->booking_id }} | Print Proforma</title>
</head>
<body>
	<div class="wrapper">
		<p style="margin-top: 10px; margin-left: 50px;">Proforma-{{ $proforma->id }}</p>
		<div class="date">
			<p>{{ $proforma->created_at }}</p>
		</div>

		<div class="image">
			<img src="{{ asset('images/acikgise-logo.png') }}" style="max-width: 300px; margin: 100px 250px 20px 325px; max-height: 50px;">
		</div>

		<div class="center">
			<h2>ACIKGISE BILET HIZMETLERI ve ORGANIZASYON A.S.</h2>
		</div>

		<div class="center">
			<p class="info">Yildiz Posta Caddesi Cerrahoglu Is Merkezi No:17 Zemin Kat 34394</p>
			<p class="info">Esentepe-Sisli-ISTANBUL</p>
			<p class="info">VAT: Mecidiyekoy Vergi Dairesi | VAT Number: 0060483600</p>
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
					<tr style="max-height: 50px;">
						<td width="40%">
							<b>TO</b>
						</td>
						<td width="30%"><p class="fs-14">{{ $customer->first_name }}</p></td>
						<td width="30%"><p class="fs-14">{{ $customer->address . ' ' . $customer->city . ' ' . $customer->province . ' ' . $customer->zip_code . ' ' . $customer->country}}</p></td>
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
							<p class="fs-14">2017 Turkish Airlines EuroLeague Final Four Istanbul</p>
						</td>
						<td width="30%">
							@for($i = 0; $i <= sizeof($tickets) -1; $i++)
								<p class="fs-14">{{ $tickets[$i] }} x {{ $categories[$i] }} Tickets</p>
							@endfor
						</td>
						<td width="30%">
							<p class="fs-14">{{ $proforma->total }} EUR</p>
						</td>
					</tr>
					<tr>
						<td width="40%">PRICE BREAKDOWN</td>
						<td width="30%">
							<p style="font-size: 13px;">VAT: {{ $proforma->vat }} EUR</p>
							<p style="font-size: 13px;">TAX: {{ $proforma->tax }} EUR</p>
							<p style="font-size: 13px;">NET PRICE: {{ $proforma->net_price }} EUR</p>
						</td>
						<td width="30%">
							
						</td>
					</tr>
					<tr>
						<td width="40%"></td>
						<td width="30%"></td>
						<td width="30%">
							<p><strong>TOTAL: {{ $proforma->total }} EUR</strong></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="left">
			<p class="fs-14"><b>Bank Name:</b> FINANSBANK</p>
			<p class="fs-14"><b>Bank Branch Name:</b> AKDENIZ SUBESI</p>
			<p class="fs-14"><b>Branch Number:</b> 941</p>
			<p class="fs-14"><b>Account Name:</b> ACIKGISE BILET HIZMETLERI VE ORGANIZASYON A.S.</p>
			<p class="fs-14"><b>SWIFT Code:</b> FNNBTRISXXX</p>
			<p class="fs-14"><b>IBAN:</b> TR28 0011 1000 0000 0059 6560 71</p>
			<p style="margin-top: 20px; color: red">Please note all bank transfer expenses will be covered by you.</p>
			<p style="color: red;">PAYMENT MUST BE DONE IN EUROS</p>
		</div>
	</div>
</body>
</html>