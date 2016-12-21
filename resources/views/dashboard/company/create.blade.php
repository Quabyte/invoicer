@extends('layouts.app')

@section('title', 'Create New Company')

@section('content')
	<div class="container-fluid">
		<div class="row">
			@if (count($errors) > 0)
			    <div class="alert alert-danger alert-dismissible">
			    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<form method="post" action="{{ action('CompanyController@store') }}">
				{{ csrf_field() }}
				<div class="col-md-9" style="padding-left: 20px;">
					<h2>Create New Company</h2>
				</div>
				<div class="col-md-3" style="padding-right: 20px;">
					<div class="pull-right" style="margin-top: 20px;">
						<input type="submit" value="Create Company" class="btn btn-primary">
						<a href="{{ url('/') }}" class="btn btn-default">Cancel</a>
					</div>
				</div>
				<div class="col-md-6" style="padding-left: 20px;">
					<div class="panel panel-default">
						<div class="panel-heading">
							Company Details
						</div>

						<div class="panel-body">
								
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Company Name</label>
										<input type="text" name="name" class="form-control" value="{{ old('name') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									    <label for="companyLogo">Company Logo</label>
									    <input type="file" id="companyLogo">
								    	<p class="help-block">Please upload the company logo to be shown on invoices.</p>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="telephone">Telephone Number</label>
										<input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="fax">Fax Number</label>
										<input type="text" name="fax" class="form-control" value="{{ old('fax') }}">
									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="administration">Tax Administration</label>
										<input type="text" name="administration" class="form-control" value="{{ old('administration') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="taxNumber">Tax Number</label>
										<input type="text" name="taxNumber" class="form-control" value="{{ old('taxNumber') }}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="mersis">Mersis Number</label>
										<input type="text" name="mersis" class="form-control" value="{{ old('mersis') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="vat">VAT Percentage</label>
										<input type="text" name="vat" class="form-control" value="{{ old('vat') }}">
									</div>
								</div>
							</div>
								
							<label for="address">Company Address</label>
							<textarea name="address" class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-6" style="padding-right: 20px;">
					<div class="panel panel-default">
						<div class="panel-heading">
							Bank Account Details
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="bankName">Bank Name</label>
										<input type="text" name="bankName" class="form-control" value="{{ old('bankName') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									    <label for="bankBranch">Bank Branch</label>
										<input type="text" name="bankBranch" class="form-control" value="{{ old('bankBranch') }}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="branchNumber">Bank Branch Number</label>
										<input type="text" name="branchNumber" class="form-control" value="{{ old('branchNumber') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									    <label for="accountNumber">Account Number</label>
										<input type="text" name="accountNumber" class="form-control" value="{{ old('accountNumber') }}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="swiftCode">SWIFT Code</label>
										<input type="text" name="swiftCode" class="form-control" value="{{ old('swiftCode') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									    <label for="iban">IBAN Number</label>
										<input type="text" name="iban" class="form-control" value="{{ old('iban') }}">
									</div>
								</div>
							</div>

							<label for="branchAddress">Branch Address</label>
							<textarea name="branchAddress" class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		
	</div>
@stop