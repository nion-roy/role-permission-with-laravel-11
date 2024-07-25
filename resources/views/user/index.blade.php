@extends('layouts.backend.app')

@section('main_content')
	<div class="container">

		@can('create user')
			<a href="{{ route('users.create') }}" class="btn btn-info mb-2">Add New User</a>
		@endcan

		<table class="table table-striped table-bordered align-middle">
			<thead>
				<tr>
					<td>#</td>
					<td>Name</td>
					<td>Email</td>
					<td>Role</td>
					@if (auth()->user()->can('update user') || auth()->user()->can('delete user'))
						<td>Action</td>
					@endif
				</tr>
			</thead>

			<tbody>
				@foreach ($users as $key => $user)
					<tr>
						<td>{{ str_pad($key + 1, 2, 0, STR_PAD_LEFT) }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->role }}</td>
						@if (auth()->user()->can('update user') || auth()->user()->can('delete user'))
							<td class="d-flex align-items-center gap-1">
								@can('update user')
									<a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a>
								@endcan

								@can('delete user')
									<form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
