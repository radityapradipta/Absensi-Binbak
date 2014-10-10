@extends('layouts.main')

@section('content')
<div class="page_title">
    Welcome
</div>
@if(Auth::check())
<div class="page_content">
    <div class="page_content_solo">
        	<p>Welcome, {{ Auth::user()->username }}</p>
	</div>
</div>
@else
	<div class="page_content">
		<p>Please Login First!</p><br>
		<div><a href ="{{ URL::route('login') }}">Login</a></div>
	</div>
@endif


@stop