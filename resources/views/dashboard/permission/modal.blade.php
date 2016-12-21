<div class="modal fade" tabindex="-1" role="dialog" id="permissionModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Permissions</h4>
			</div>

			<div class="modal-body">

				<div class="row">
					<div class="col-md-12">
						<h4>Current Permissions</h4>
					</div>
					
					<div class="col-md-12">
						@if (count($permissions))
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Role ID</th>
										<th>Actions</th>
									</tr>
								</thead>
						
								<tbody>
									@foreach ($permissions as $permission)
										<tr>
											<td>{{ $permission->name }}</td>
											<td>{{ $permission->role_id }}</td>
											<td></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>There are no permissions to show!</p>
						@endif
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<h4>Create New Permission</h4>
					</div>
					<form method="post" action="{{ action('PermissionsController@store') }}">
						{{ csrf_field() }}
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Permission Name</label>
								<input type="text" name="name" class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="roleID">Select Role</label>
								<select name="roleID" class="form-control">
									@foreach ($roles as $role)
										<option value="{{ $role->id }}">{{ $role->display_name }}</option>
									@endforeach
								</select>
							</div>
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