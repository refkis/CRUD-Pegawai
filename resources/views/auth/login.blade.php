<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pegawai</title>
	<link rel="stylesheet" href="{{url('css/login.css')}}">
	<link rel="stylesheet" href="{{url('css/bootstrap513.css')}}">
</head>

<body>
	<!-- WRAPPER -->
	<main class="form-signin">
		<div class="text-center">
			<img src="/images/logo/logo.png" alt="" width="80%">
		</div>
		<div class="mb-3"></div>
		@if ($errors->any())
		<div id="danger" class="alert alert-danger ">
			<ul>
				@foreach ($errors->all() as $error)
				<li class="btn-toastr">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		</div>

		<form action="/postlogin" method="post">
			{{csrf_field()}}
			@if (Auth::guest())
			<label for="username">Username</label>
			<div class="mb-3">
				<input name="username" class="form-control " id="username" placeholder="username">
			</div>
			<label for="password">Password</label>
			<div class=" mb-3">
				<input name="password" class="form-control " type="password" placeholder="password">
			</div>
			<div class=" mb-3"></div>
			<div class="form-group ">
				<button class="btn btn-primary btn-lg w-100" type="submit">LOGIN</button>
			</div>
		</form>

		@endif
		@if (Auth::user())
		<label>Selamat datang <b>{{auth()->user()->username}}</b></label><br>
		<a href="/" span>Halaman Depan</span></a><br>
		<a href="/logout" method="post">Logout</a><br>
		@endif

	</main>
</body>

</html>