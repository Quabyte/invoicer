@extends('layouts.app')

@section('title', 'Companies')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					List of Companies
				</div>
				<div class="panel-body">
					@if (count($companies) < 1)
						<p>There are no companies to show!</p>
						<a href="{{ action('CompanyController@create') }}" class="btn btn-success">Create New Company</a>
					@else
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Address</th>
									<th>Tax Number</th>
									<th>VAT</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($companies as $company)
									<tr>
										<td>{{ $company->name }}</td>
										<td>{{ $company->address }}</td>
										<td>{{ $company->tax_number }}</td>
										<td>{{ $company->vat }}</td>
										<td></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop