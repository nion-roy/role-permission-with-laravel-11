@extends('layouts.backend.app')

@section('main_content')
	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-12 mx-auto">
				<div class="card">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h3>Update Role</h3>
					</div>
					<div class="card-body">

						@if (session('success'))
							<div class="alert alert-success alert-dismissible fade show" user="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						<form action="{{ route('roles.update', $role->id) }}" method="post">
							@csrf
							@method('PUT')

							<div class="form-group mb-3">
								<label for="name" class="form-label">Role Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ?? $role->name }}" placeholder="Enter name">
								@error('name')
									<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>


							<h4>Permissions</h4>
							<hr>

							<div class="form-group mb-3">
								<input type="checkbox" id="selectAll" class="form-input">
								<label for="selectAll" id="selectLabel" class="form-label">Select All</label>
							</div>

							<div class="row">
								@foreach ($permissions as $permission)
									<div class="col-lg-3">
										<div class="form-group">
											<input type="checkbox" name="permission[]" class="rolePermission" id="{{ $permission->id }}" value="{{ $permission->name }}" {{ in_array($permission->id, $permissionRole) ? 'checked' : '' }}>
											<label for="{{ $permission->id }}" class="form-label">{{ $permission->name }}</label>
										</div>
									</div>
								@endforeach
							</div>

							<div class="form-group">
								<button class="btn btn-success">Update Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@push('js')
	<script>
		$("#selectAll").click(function() {
			$("input[type=checkbox]").prop("checked", $(this).prop("checked"));
		});

		$("input[type=checkbox]").click(function() {
			if (!$(this).prop("checked")) {
				$("#selectAll").prop("checked", false);
			}
		});

		// Check if all checkboxes with class rolePermission are checked
		if ($(".rolePermission:checked").length === $(".rolePermission").length) {
			$("#selectAll").prop("checked", true);
		}
	</script>
@endpush
