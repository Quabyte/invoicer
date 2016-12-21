@extends('layouts.app')

@section('title', 'Create New User')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="POST" action="{{ action('UsersController@store') }}">
					{{ csrf_field() }}
					
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="password">Password</label>
						<input type="text" name="password" class="form-control">
					</div>

					<div class="form-group">
						<label for="roleID">Role ID</label>
						<input type="text" name="roleID" class="form-control">
					</div>

					<input type="submit" class="btn btn-success" value="Create">
				</form>
			</div>
		</div>
	</div>
@stop