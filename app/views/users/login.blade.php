<!DOCTYPE html>
<html lang="en">
		{{ HTML::script('js/jquery-1.11.1.min.js') }}
		{{ HTML::script('js/custom.js') }}
	<head>		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		 <!-- Normalize -->
		<link href="{{ asset('assets/css/normalize.css') }}" rel="stylesheet">
		
		<!-- Bootstrap -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		
		<!-- Bootstrap Custom -->
		<link href="{{ asset('assets/css/bootstrap_custom.css') }}" rel="stylesheet">
		
		<!-- Custom -->
		<link href="{{ asset('assets/css/custom_style_00.css') }}" rel="stylesheet">
		<title>
		
		</title>
	</head>
	
	<body>
		<section class="wrapper">
			<section class="main_content_wrapper">
				<div class="page_content">
					<div class="tableed">
						<div class="celled">
							<div class="rubirosa_logo_center">
								<span class="logo_center"></span>
							</div>
						</div>
					</div>	
				</div>
				<div class="page_title">
					<div class="tableed">
						<div class="celled">		
							<div class="page_content">
								<div class="head_logo">
									<img src="{{ asset('assets/img/logo.png') }}">
								</div>
								
								<div class="head_title">
									<h2>SISTEM ABSENSI BINA BAKTI</h2>
								</div>
							</div>
						</div>	
					</div>
				</div>
				<div class="login_content">
					<form action="{{ URL::route('account-sign-in-post') }}" method="post">
						<input type="input" class="content_text_field" name="username" placeholder="Username" {{ (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }}/ style="display:block;">
						@if($errors->has('username'))
							{{ $errors->first('username') }}
						@endif
						<input type="password" class="content_text_field" name="password" placeholder="Password"/ style="display:block;">
						@if($errors->has('password'))
							{{ $errors->first('password') }}
						@endif
						<div class="content_button">
							<input type="submit" class="btn btn-primary-mod" value="Log In">
						</div>

					</form>
				</div>
			</section>
		</section>
	</body>
</html>	