<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pegawai</title>
	<link rel="stylesheet" href="{{url('css/datatables.css')}}">
	<link rel="stylesheet" href="{{url('css/bootstrap513.css')}}">
</head>

<body>
	<!-- WRAPPER -->
	<div class="container">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box register">
					<div class="content">
						<div class="header">
							<p class="lead">Form Login</p>
						</div>
						@if ($errors->any())
						<div id="danger" class="alert alert-danger ">
							<ul>
								@foreach ($errors->all() as $error)
								<li class="btn-toastr">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						@if(session('gagal'))
						<div id="toast-container" class="toast-bottom-center">
							<div class="toast toast-error " aria-live="polite" style="display: block;">
								<div class="toast-message">Login Gagal</div>
							</div>
						</div>
						@endif

						<form action="/postlogin" method="post">
							{{csrf_field()}}
							@if (Auth::guest())
							<div class="form-group">
								<label>Email</label>
								<input name="username" type="username" class="form-control" id="username" value="" placeholder="Username">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input name="password" type="password" class="form-control" id="password" value="" placeholder="Password">						
							</div>
							<div class="form-group ">
								<button class="btn btn-primary" type="submit">LOGIN</button>
							</div>
						</form>
						@endif
						@if (Auth::user())
						<label>Selamat datang <b>{{auth()->user()->username}}</b></label><br>
						<a href="/" span>Halaman Depan</span></a><br>
						<a href="/logout" method="post">Logout</a><br>
						@endif
					</div>
				</div>
			</div>
		</div>
</body>
</html>