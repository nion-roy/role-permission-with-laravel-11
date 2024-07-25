@extends('layouts.backend.app')

@section('main_content')
	<div class="container">

		@can('create permission')
			<a href="{{ route('permissions.create') }}" class="btn btn-info mb-2">Add New Permission</a>
		@endcan

		<table class="table table-striped table-bordered align-middle">
			<thead>
				<tr>
					<td>#</td>
					<td>Permission</td>
					<td>Guard Name</td>
					@if (auth()->user()->can('update permission') || auth()->user()->can('delete permission'))
						<td>Action</td>
					@endif
				</tr>
			</thead>

			<tbody>
				@foreach ($permissions as $key => $permission)
					<tr>
						<td>{{ str_pad($key + 1, 2, 0, STR_PAD_LEFT) }}</td>
						<td>{{ $permission->name }}</td>
						<td>{{ $permission->guard_name }}</td>
						@if (auth()->user()->can('update permission') || auth()->user()->can('delete permission'))
							<td class="d-flex align-items-center gap-1">
								@can('update permission')
									<a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-success">Edit</a>
								@endcan

								@can('delete permission')
									<form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
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
