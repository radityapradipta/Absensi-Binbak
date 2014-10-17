@extends('layouts.main')

@section('content')
	<br class="clear"/><br/><br/><br/>
	<div style="width:75%;display:block;text-align:center;">
		<div class="head_logo">
			<img src="{{ asset('assets/img/logo.png') }}">
		</div>
		<div class="head_title">
			<h2>SISTEM INFORMASI ABSENSI BINA BAKTI</h2>
		</div>
	</div>	
	
	<br class="clear"/><br/>
	@if(Auth::check())
	<div class="page_title">
		Welcome, {{ ucfirst(Auth::user()->username) }} &nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
	</div><!--
	<div class="page_content">
		<div class="page_content_solo">
				<p>Welcome, {{ ucfirst(Auth::user()->username) }}</p>
		</div>
	</div>-->
	@else
		<div class="page_content">
			<p>Please Login First!</p><br>
			<div><a href ="{{ URL::route('login') }}">Login</a></div>
		</div>
	@endif


@stop