@extends('layout.main')

@section('content')
<form>
	<div class="page_title">
		Convert Document
	</div>
	
	<div class="page_content">
		<div class="page_content_solo">
			<input type="file"/>
			
			<div class="content_button">
				<button type="button" class="btn btn-primary-mod">Convert File</button>
			</div>
		</div>
		
		<div class="page_content_under">
			
		</div>
	</div>
</form>
@stop