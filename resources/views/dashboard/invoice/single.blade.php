@extends('layouts.app')

@section('title', 'Generate Invoice')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $invoice->transaction_id }}

					<div class="pull-right">
						<a href="{{ action('InvoiceController@preview', ['id' => $invoice->id]) }}" class="btn btn-default btn-xs">
							<i class="glyphicon glyphicon-print"></i> Print
						</a>
					</div>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<p>{{ $invoice->customer_name }}</p>
							<p>{{ $invoice->address }}</p>
							<p>{{ $invoice->zip_code }}</p>
							<p>{{ $invoice->province }} / {{ $invoice->country }}</p>
						</div>

						<div class="col-md-6">
							<p>Tarih: {{ $invoice->generated }}</p>
							<p>Fatura No: {{ $invoice->transaction_id }}</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<p>Açıklama: {{ $invoice->package }}</p>
							<p>KDV'li Matrah: {{ App\Invoice::convertToTL($invoice->total - $invoice->tax) }} TL</p>
							<p>KDV % 18: {{ App\Invoice::convertToTL($invoice->tax) }} TL</p>
							<p>GENEL TOPLAM: {{ App\Invoice::convertToTL($invoice->total) }} TL</p>
							<p>TOTAL AMOUNT: {{ $invoice->total }}€</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop