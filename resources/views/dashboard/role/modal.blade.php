<div class="modal fade" tabindex="-1" role="dialog" id="roleModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Roles</h4>
			</div>

			<div class="modal-body">

				<div class="row">
					<div class="col-md-12">
						<h4>Current Roles</h4>
					</div>
					
					<div class="col-md-12">
						@if (count($roles))
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Display Name</th>
										<th>Description</th>
										<th>Actions</th>
									</tr>
								</thead>
						
								<tbody>
									@foreach ($roles as $role)
										<tr>
											<td>{{ $role->name }}</td>
											<td>{{ $role->display_name }}</td>
											<td>{{ $role->description }}</td>
											<td>
												<a href="{{ action('RolesController@edit', ['id' => $role->id]) }}" class="text-default">
													Edit
												</a>
												<a href="{{ action('RolesController@destroy', ['id' => $role->id]) }}" class="text-danger">
													Delete
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>There are no roles to show!</p>
						@endif
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<h4>Create New Role</h4>
					</div>
					<form method="post" action="{{ action('RolesController@store') }}">
						{{ csrf_field() }}
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Role Name</label>
								<input type="text" name="name" class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="displayName">Display Name</label>
								<input type="text" name="displayName" class="form-control">
							</div>
						</div>
						
						<div class="col-md-12">
							<label for="description">Role Description</label>
							<textarea name="description" class="form-control" rows="3"></textarea>
						</div>
						
						<div class="col-md-12" style="margin-top: 20px;">
							<input type="submit" class="btn btn-sm btn-primary" value="Create">
						</div>
					</form>	
				</div>

			</div>
		</div>
	</div>
</div>