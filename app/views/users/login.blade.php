<!DOCTYPE html>
<html lang="en">
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
		{{ HTML::style('assets/css/fluid_grid.css') }}
        <title>

        </title>
    </head>

    <body>
        <!--<section class="wrapper">
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
                                    <h2>SISTEM INFORMASI ABSENSI BINA BAKTI</h2>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
                <div class="login_content">
                    <form action="{{ URL::route('account-sign-in-post') }}" method="post" class="container_12">
                        <input type="input" class="content_text_field grid_4" name="username" placeholder="Username" required{{ (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }}/ style="display:block;">
                               <input type="password" class="content_text_field" name="password" placeholder="Password" required / style="display:block;">
                               @if(Session::has('global'))
                               <p>{{ Session::get('global') }}</p>
								@endif
                        <div class="content_button">
                            <input type="submit" class="btn btn-primary-mod" value="Log In">
                        </div>
                        {{ Form::token() }}
                    </form>
                </div>
            </section>
        </section>-->
		
		<div class="container_12">
			<div class="grid_2">
				&nbsp;
			</div>
			<div class="grid_8" style="text-align:center;">			
				<br class="clear"/><br/><br/><br/>
				<div class="head_logo">
					<img src="{{ asset('assets/img/logo.png') }}">
				</div>
				<div class="head_title">
					<h2>SISTEM INFORMASI ABSENSI BINA BAKTI</h2>
				</div>
				
				
				
				<div class="grid_4">
					&nbsp;
				</div>
				<div class="grid_4">
					<br class="clear"/><br/>
					<form action="{{ URL::route('account-sign-in-post') }}" method="post">
						<input type="input" class="content_text_field" name="username" placeholder="Username" required{{ (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }}/ style="display:block;">
							   <input type="password" class="content_text_field" name="password" placeholder="Password" required / style="display:block;">
							   @if(Session::has('global'))
							   <p>{{ Session::get('global') }}</p>
								@endif
						<div class="content_button">
							<button type="submit" class="btn btn-primary-mod" style="width:100%;;">
								Log In &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span>
							</button>
						</div>
						{{ Form::token() }}
					</form>					
				</div>	
				<br class="clear"/><br/><br/><br/>
				@if (isset($message))
					<span class="alert alert-danger" role="alert" style="">{{{ $message }}}</span>
				@endif
			</div>
		</div>
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/custom.js') }}
    </body>
</html>	