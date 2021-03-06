<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login/css/main.css') }}">	
</head>
<body>
	@if($message = Session::get('success'))
	<div id="alertsucess" data-alert="{{ $message }}"></div>
	@elseif($message = Session::get('error'))
	<div id="alertgagal" data-alert="{{ $message }}"></div>
	@endif	
	
	<div class="limiter">
		<!-- <div class="container-login100 bg-success"> -->
			<div class="container-login100" style="background-image: url('{{ asset('/login/images/logo3.jpg') }}');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					<div>
						<img src="{{ asset('/login/images/pdam.png') }}" style="width:70%">
					</div>
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" action="{{ url('admin/login/proses') }}" method="POST">
                    @csrf
					<div class="wrap-input100 validate-input" data-validate = "Masukkan Email">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Masukkan password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						{{-- <button class="login100-form-btn">
							Login
						</button> --}}
						<button class="btn-outline-success btn  btn-lg" style="width: 40%;border-radius: 35px;">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

	<script src="{{ asset('/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('/login/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('/login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/login/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('/login/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('/login/vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ asset('/login/js/main.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$(document).ready(function(){
			const success 	= $('#alertsuccess').data('alert');
			const gagal 	= $('#alertgagal').data('alert');
			if(gagal){
				Swal.fire(
					'Gagal',
					gagal,
					'error'
				)
			}else if(success){
				Swal.fire(
					'Success',
					success,
					'success'
				)
			}
		});
	</script>

</body>
</html>