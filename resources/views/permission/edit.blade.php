@extends('layouts.backend.app')

@section('main_content')
	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-12 mx-auto">
				<div class="card">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h3>Update Permission</h3>
					</div>
					<div class="card-body">

						@if (session('success'))
							<div class="alert alert-success alert-dismissible fade show" user="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						<form action="{{ route('permissions.update', $permission->id) }}" method="post">
							@csrf
              @method('PUT')

							<div class="form-group mb-3">
								<label for="name" class="form-label">Permission Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ?? $permission->name }}" placeholder="Enter name">
								@error('name')
									<div class="text-danger">{{ $message }}</div>
								@enderror
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
