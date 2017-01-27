@extends('layouts.app')

@section('title', 'Edit Proforma')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					PROFORMA ID: {{ $proforma->id }}

					<div class="pull-right">
						<p>Update Count: {{ $proforma->generate_count }}</p>
					</div>
				</div>

				<div class="panel-body">
					<form method="POST" action="{{ action('ProformaController@update', ['id' => $proforma->id]) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="bookingRef">Bookin Ref</label>
									<p class="form-control-static">{{ $proforma->booking_id }}</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="generatedBy">Generated By</label>
									<p class="form-control-static">{{ $user->name }}</p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="total">Total Amount</label>
									<input type="text" name="total" class="form-control" value="{{ $proforma->total }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="createdAt">Proforma Date</label>
									<input type="text" name="createdAt" class="form-control" value="{{ $proforma->created_at }}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="vat">VAT</label>
									<input type="text" name="vat" class="form-control" value="{{ $proforma->vat }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="tax">Tax</label>
									<input type="text" name="tax" class="form-control" value="{{ $proforma->tax }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="net">Net Price</label>
									<input type="text" name="net" class="form-control" value="{{ $proforma->net_price }}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="customerName">Customer Name</label>
									<input type="text" name="customerName" class="form-control" value="{{ $customer->first_name }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="customerAddress">Customer Address</label>
									<textarea class="form-control" name="customerAddress">{{ $customer->address . ' ' . $customer->city . ' ' . $customer->province . ' ' . $customer->zip_code . ' ' . $customer->country }}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-6">
                                <a href="{{ action('RequestController@singleCustomer', ['id' => $customer->id]) }}" class="btn btn-primary">Update Customer</a>
                            </div>
							<div class="col-md-6">
								<div class="pull-right">
									<input type="submit" value="Update" class="btn btn-success">
									<a href="{{ action('ProformaController@generatedList') }}"> Cancel</a>
								</div>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@stop