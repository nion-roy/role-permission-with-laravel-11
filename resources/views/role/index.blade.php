@extends('layouts.backend.app')

@section('main_content')
	<div class="container">

		@can('create role')
			<a href="{{ route('roles.create') }}" class="btn btn-info mb-2">Add New Role</a>
		@endcan

		<table class="table table-striped table-bordered align-middle">
			<thead>
				<tr>
					<td>#</td>
					<td>Role</td>
					<td>Guard Name</td>
					@if (auth()->user()->can('update role') || auth()->user()->can('delete role'))
						<td>Action</td>
					@endif
				</tr>
			</thead>

			<tbody>
				@foreach ($roles as $key => $role)
					<tr>
						<td>{{ str_pad($key + 1, 2, 0, STR_PAD_LEFT) }}</td>
						<td>{{ $role->name }}</td>
						<td>{{ $role->guard_name }}</td>
						@if (auth()->user()->can('update role') || auth()->user()->can('delete role'))
							<td class="d-flex align-items-center gap-1">
								@can('update role')
									<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success">Edit</a>
								@endcan

								@can('delete role')
									<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger">Delete</button>
									</form>
								@endcan
							</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
@endsection
