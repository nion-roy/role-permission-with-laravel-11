@extends('layouts.backend.app')

@section('main_content')
	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-12 mx-auto">
				<div class="card">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h3>Create Role</h3>
					</div>
					<div class="card-body">

						@if (session('success'))
							<div class="alert alert-success alert-dismissible fade show" user="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						<form action="{{ route('roles.store') }}" method="post">
							@csrf

							<div class="form-group mb-3">
								<label for="name" class="form-label">Role Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Enter name">
								@error('name')
									<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group">
								<button class="btn btn-success">Add Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
