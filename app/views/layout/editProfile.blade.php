@extends('layout.main')

@section('content')
<form>
	<div class="page_title">
		Edit Profile
	</div>
	
	<div class="page_content">
		<div class="page_content_left">
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Input old password
			</div>
			
			<div class="content_field">

					<input type="password" class="content_text_field">

			</div>
			<!---------------- Da Text Field -------------------->
			
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Input new password
			</div>
			
			<div class="content_field">
	
					<input type="password" class="content_text_field">
		
			</div>
			<!---------------- Da Text Field -------------------->
			
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Confirm new password
			</div>
			
			<div class="content_field">
		
					<input type="password" class="content_text_field">
	
			</div>
			<!---------------- Da Text Field -------------------->
			
			<div class="content_button">
				<button type="button" class="btn btn-primary-mod">Confirm</button>
			</div>
		</div>
		
		<div class="page_content_right">
			
		</div>
	</div>
</form>
@stop