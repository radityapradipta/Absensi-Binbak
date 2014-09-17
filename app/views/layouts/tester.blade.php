<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Laravel</title>
		{{ HTML::style('css/foundation.css') }}
		{{ HTML::script('js/vendor/modernizr.js') }}
	</head>
	<body>
    
		<div class="row">
			<div class="large-12 columns">
				<h1>Laravel</h1>
			</div>
		</div>
		
		@section('custom')
            This is the master sidebar.
        @show		
		
		<div class="row">
			<div class="large-12 columns">
				@yield('content')
			</div>
		</div>
    
		{{ HTML::script('js/vendor/jquery.js') }}
		{{ HTML::script('js/foundation.min.js') }}
		<script>
			$(document).foundation();
		</script>
	</body>
</html>
