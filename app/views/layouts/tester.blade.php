<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Laravel</title>
		{{-- HTML::style('css/foundation.css') --}}
		{{-- HTML::script('js/vendor/modernizr.js') --}}
		
		<style>
			.absent-table{
				font-size:0.8em;
				font-family: "Arial Narrow", Arial, sans-serif;
				border-collapse:collapse;				
			}
			.absent-row:nth-child(odd){
				background-color:rgba(41, 128, 185,0.15);
			}
			.absent-table th{				
				color:black;
				font-weight:normal;
				padding:7.5px 3px 5px 3px;
				border-bottom:3px solid rgba(41, 128, 185,1.0);
				border-top:3px solid rgba(41, 128, 185,1.0);
			}			
			.absent-table td{
				padding:5.5px 3px 3px 3px;
			}
			
			
			.weekend{
				background-color:rgba(22, 160, 133,0.25);
			}
			.weekday{
				background-color:rgba(41, 128, 185,0.25);
			}
			.absent{
				background-color:rgba(142, 68, 173,0.25);
			}
			.number{
				text-align:right;
				width:72px;
			}
			.thick-border{
				border-right:3px solid rgba(41, 128, 185,1.0);
			}
			.thin-border{
				border-right:1px solid rgba(41, 128, 185,1.0);
			}
		</style>
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
    
		{{-- HTML::script('js/vendor/jquery.js') --}}
		{{-- HTML::script('js/foundation.min.js') --}}
		<script>
			//$(document).foundation();
		</script>
	</body>
</html>
