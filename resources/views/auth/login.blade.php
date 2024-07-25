<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	</head>

	<body>

		<div class="container mb-5">
			<h2 class="bg-success p-3 rounded text-center text-white">Role & Permission Managment with Laravel 11</h2>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-4 mx-auto">
					<form action="{{ route('login') }}" method="POST">
						@csrf
            
						<div class="mb-3">
							<label for="email" class="form-label">Email address</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" required>
							@error('email')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password">
							@error('password')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<button type="submit" class="btn btn-primary w-100">Submit</button>
					</form>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	</body>

</html>
