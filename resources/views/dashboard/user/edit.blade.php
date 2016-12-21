@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit {{ $user->name }}
				</div>

				<div class="panel-body">
					{{ $user->name }}
					{{ $user->email }}
				</div>
			</div>
		</div>
	</div>
@stop