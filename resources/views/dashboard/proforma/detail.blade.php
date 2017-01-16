@extends('layouts.app')

@section('title', 'Proforma Details')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					BOOKING REF: {{ $booking->booking_id }}
					
					@if (App\Proforma::checkIfGenerated($booking->booking_id))
						<button data-toggle="modal" data-target="#proformaModal" class="btn btn-success btn-xs pull-right">
							<i class="glyphicon glyphicon-check"></i> Generate Proforma
						</button>
					@else
						<a href="{{ action('ProformaController@edit', ['id' => $proforma->id]) }}" class="btn btn-primary btn-xs pull-right">
							<i class="glyphicon glyphicon-pencil"></i> Edit Proforma
						</a>
					@endif
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<h4>Booking Details</h4>
							<p>Booking Details: {{ $booking->booking_id }}</p>
							<p>Booking Time: {{ $booking->time }}</p>
						</div>
						<div class="col-md-4">
							<h4>Booking Items</h4>
							@foreach ($tickets as $ticket => $count)
								<p>{{ $count . ' x ' . $ticket . ' Tickets' }}</p>
							@endforeach
						</div>
						<div class="col-md-4">
							<h4>Customer Details</h4>
							@if ($assignee->count() > 0)
								@foreach ($assignee as $customer)
									<p>Name: {{ $customer->first_name }}</p>
									<p>Address: {{ $customer->address }}</p>
									<p>ZIP: {{ $customer->zip_code }}</p>
									<p>City: {{ $customer->city }} / Country: {{ $customer->country }}</p>
								@endforeach
							@else
								<p>No assigned customers found!</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@include('dashboard.proforma.create')