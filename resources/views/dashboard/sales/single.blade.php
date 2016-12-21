@extends('layouts.app')

@section('title', 'Transaction')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $transaction->transaction_id }}

					<button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#invoiceModal">
						<i class="glyphicon glyphicon-list-alt"></i> Invoice
					</button>
				</div>

				<div class="panel-body">

					<div class="row">
						<div class="col-md-12">
							<h4>
								{{ $customer->first_name . ' ' . $customer->second_name }}
							</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<h4>General Info</h4>
							<p>
								Transaction Time: {{ $transaction->time }}
							</p>
							<p>
								Canceled: {{ $transaction->is_cancelled }}
							</p>
						</div>
						<div class="col-md-4">
							<h4>Transaction Info</h4>
							<p>
								Payment Method: {{ $transaction->payment_method }}
							</p>
							<p>
								Channel: {{ $transaction->channel }}
							</p>
							<p>
								Type: {{ $transaction->transaction_type }}
							</p>
						</div>
						<div class="col-md-4">
							<h4>Payment Details</h4>
							<p>
								Net Price: {{ App/Item::calculateNetPrice($transaction->transaction_id) }}€
							</p>
							<p>
								Bank Comission: {{ App/Item::calculateFees($transaction->transaction_id) }}€
							</p>
							<p>
								Total: {{ App/Item::calculateTotal($transaction->transaction_id) }}€
							</p>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<h4>Address Information</h4>
						</div>
						<div class="col-md-4">
							<p>{{ $customer->address }}</p>
							<p>ZIP Code: {{ $customer->zip_code }}</p>
							<p>Province: {{ $customer->province }}</p>
							<p>Country: {{ $customer->country }}</p>
						</div>
						<div class="col-md-4">
							<p>Telephone: {{ $customer->telephone }}</p>
							<p>Email: {{ $customer->email }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('beforeScripts')
	@include('dashboard.invoice.create')
@stop