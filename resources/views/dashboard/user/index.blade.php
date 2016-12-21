@extends('layouts.app')

@section('title', 'Users and Permissions')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					Users & Permissions
					<div class="pull-right">
						<a href="{{ action('UsersController@create') }}" class="btn btn-xs btn-primary">Create User</a>
						<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#roleModal">Create Role</button>
						<button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#permissionModal">Create Permission</button>
					</div>
				</div>

				<div class="panel-body">
					@if (count($users) < 1)
						<p>There are no companies to show!</p>
						<a href="{{ action('UsersController@create') }}" class="btn btn-success">Create New User</a>
					@else
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Actions</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($users as $user)
									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->role_id }}</td>
										<td>
											<a href="{{ action('UsersController@edit', ['id' => $user->id]) }}" class="text-default">
												Edit
											</a>
											<a href="#" class="text-danger">Delete</a>
										</td>
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

@section('beforeScripts')
	@include('dashboard.role.modal')
	@include('dashboard.permission.modal')
@stop