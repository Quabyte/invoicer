@extends('layouts.app')

@section('title', 'Proformas')

@section('customCss')
	<link rel="stylesheet" type="text/css" href="{{ asset('dataTables/datatables.min.css') }}">
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					LATEST BOOKINGS
					@if (Auth::check() && App\User::checkEuroleague())
						<a href="{{ action('RequestController@getBookings', ['baseUrl' => 'https://euroleague.acikgise.com']) }}" class="btn btn-success btn-xs pull-right">Refresh</a>
						<form action="{{ url('/getSingleBookingDetail') }}" method="post">
							{{ csrf_field() }}
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Transaction ID" name="bookingRef">
								</div>
							</div>
							<div class="col-md-4">
								<input type="submit" value="Get" class="btn btn-default">
							</div>
						</form>
					@endif
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered" id="dataTable">
						<thead>
							<tr>
								<th>Booking ID</th>
								<th>Time</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($bookings as $booking)
								<tr>
									<td>{{ $booking->booking_id }}</td>
									<td>{{ $booking->time }}</td>
									<td>
										<a href="{{ action('ProformaController@show', ['id' => $booking->id]) }}" class="btn btn-xs btn-default">
                                            <i class="glyphicon glyphicon-pencil"></i>
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

@section('scripts')
	<script src="{{ asset('dataTables/datatables.min.js') }}"></script>
	<script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                autoFill: true,
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            } );
        } );
    </script>
@stop