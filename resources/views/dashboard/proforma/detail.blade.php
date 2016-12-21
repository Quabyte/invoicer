@extends('layouts.app')

@section('title', 'Proforma Details')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					BOOKING REF: {{ $booking->booking_id }}

					<button data-toggle="modal" data-target="#proformaModal" class="btn btn-success btn-xs pull-right">
						<i class="glyphicon glyphicon-check"></i> Generate Proforma
					</button>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<h4>Booking details</h4>
							<p>Booking Details: {{ $booking->booking_id }}</p>
							<p>Booking Time: {{ $booking->time }}</p>
						</div>
						<div class="col-md-6">
							<h4>Booking Items</h4>
							@foreach ($items as $item)
								<div class="col-md-4">
									<p>Area: {{ $item->area }}</p>
								</div>
								<div class="col-md-4">
									<p>Zone: {{ $item->zone }}</p>
								</div>
								<div class="col-md-4">
									<p>Seat: {{ $item->seat }}</p>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@include('dashboard.proforma.create')