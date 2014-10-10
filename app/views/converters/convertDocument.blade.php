@extends('layouts.main')

@section('content')
<div class="page_title">
    Convert Document
</div>
@if(Auth::check())
	@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
	<div class="page_content">
		<div class="page_content_solo">
			<div id="fileuploader">Upload File Access</div>
			<div class="content_button">
				<button type="button" id="convert-button" class="btn btn-primary-mod">Convert File</button>
			</div>
		</div>

		<div class="page_content_under">
			<img id="loading" src="{{ asset('assets/img/LoadingCircle.gif') }}" style="display:none" />
		</div>
	</div>
	@else
		<div class="page_content">
			<p>You don't have permission to convert document!</p><br>
		</div>
	@endif
@else
	<div class="page_content">
		<p>Please Login First!</p><br>
		<div><a href ="{{ URL::route('login') }}">Login</a></div>
	</div>
@endif
@stop