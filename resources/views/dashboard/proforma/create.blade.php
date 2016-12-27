<div class="modal fade" tabindex="-1" role="dialog" id="proformaModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Proforma</h4>
			</div>

			<div class="modal-body">
				<form action="{{ action('ProformaController@store') }}" method="POST">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="customerName">Customer Name</label>
								<input type="text" name="customerName" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="proformaDate">Proforma Date</label>
								<input type="text" name="proformaDate" value="{{ $timeNow }}" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="customerAddress">Customer Address</label>
								<input type="text" name="customerAddress" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6" style="padding-top: 30px;">
							<p>Price: {{ $total }}€</p>
						</div>
					</div>

					<input type="hidden" name="bookingID" value="{{ $booking->booking_id }}">
					<input type="hidden" name="bookingTotal" value="{{ $total }}">
					<input type="submit" class="btn btn-success" value="Generate"></input>

				</form>
			</div>
		</div>
	</div>
</div>