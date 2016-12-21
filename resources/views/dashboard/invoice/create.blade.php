<div class="modal fade" tabindex="-1" role="dialog" id="invoiceModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Invoice</h4>
			</div>

			<div class="modal-body">
				<form action="{{ action('InvoiceController@store') }}" method="POST">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="customerName">Customer Name</label>
								<input type="text" name="customerName" class="form-control" 
									   value="{{ $customer->first_name . ' ' . $customer->second_name }}"
								>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="invoiceDate">Invoice Date</label>
								<input type="text" name="invoiceDate" value="07-12-2016" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="customerAddress">Customer Address</label>
								<input type="text" name="customerAddress" class="form-control" 
									   value="{{ $customer->address }}"
								>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="priceText">Price Text</label>
								<input type="text" name="priceText" class="form-control">
							</div>
						</div>
						<div class="col-md-6" style="padding-top: 30px;">
							<p>Price: {{ $total }}€</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="customerProvince">Province</label>
								<input type="text" class="form-control" name="customerProvince"
									   value="{{ $customer->province }}" 
								>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="customerZIP">ZIP Code</label>
								<input type="text" class="form-control" name="customerZIP"
									   value="{{ $customer->zip_code }}" 
								>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="customerCountry">Country</label>
								<input type="text" class="form-control" name="customerCountry"
									   value="{{ $customer->country }}" 
								>
							</div>
						</div>
					</div>
					<input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
					<input type="submit" class="btn btn-success" value="Generate"></input>

				</form>
			</div>
		</div>
	</div>
</div>