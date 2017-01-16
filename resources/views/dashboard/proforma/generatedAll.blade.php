@extends('layouts.app')

@section('title', 'List of Generated Proformas')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					LIST OF GENERATED PROFORMAS
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Booking ID</th>
								<th>Total</th>
								<th>Customer</th>
								<th>Proforma Date</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($proformas as $proforma)
								<tr>
									<td>{{ $proforma->booking_id }}</td>
									<td>{{ $proforma->total }}</td>
									<td><?php $customer = App\Customer::where('id', '=', $proforma->customer_id)->first(); ?> {{ $customer->first_name }}</td>
									<td>{{ $proforma->created_at }}</td>
									<td>
										<a href="{{ action('ProformaController@edit', ['id' => $proforma->id]) }}" class="btn btn-xs btn-default">
											<i class="glyphicon glyphicon-pencil"></i> Edit
										</a>
										<a href="{{ action('ProformaController@generateProforma', ['id' => $proforma->id]) }}" class="btn btn-xs btn-primary">
											<i class="glyphicon glyphicon-eye-open"></i> View
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop