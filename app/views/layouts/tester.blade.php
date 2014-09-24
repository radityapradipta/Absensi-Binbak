<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Laravel</title>
		{{ HTML::script('js/jquery-1.11.1.min.js') }}
		{{ HTML::script('js/custom.js') }}
		<style>
			.absent-table{
				font-size:0.8em;
				font-family: "Arial Narrow", Arial, sans-serif;
				border-collapse:collapse;				
			}
			.absent-row:nth-child(odd){
				background-color:rgba(41, 128, 185,0.05);
			}
			.absent-row:hover{
				background-color:rgba(41, 128, 185,1.0);
				color:white;
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

		@yield('content')
	
	</body>
</html>
