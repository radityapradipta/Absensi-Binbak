@extends('layouts.main')

@section('content')
<form>
	<div class="page_title">
		Manage Allowance
	</div>
	
	<div class="page_content">
		<div class="page_content_left">
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Select Unit
			</div>
			
			<div class="content_field">
				<select class="content_dropDown"/>
					<option value="u1">Unit #1</option>
					<option value="u2">Unit #2</option>
					<option value="u3">Unit #3</option>
					<option value="u4">Unit #4</option>
					<option value="u5">Unit #5</option>
				</select>
			</div>
			<!---------------- Da Text Field -------------------->

		</div>
		
		<div class="page_content_right">
			<!---------------- Da Text Field -------------------->
			<div class="content_head">
				Weekday Allowance
			</div>
			
			<div class="content_field">
				<input type="input" class="content_text_field">
			</div>	
			<!---------------- Da Text Field -------------------->
			
			<!---------------- Da Text Field -------------------->
			<div class="content_head">
				Weekend Allowance
			</div>
			
			<div class="content_field">
				<input type="input" class="content_text_field">
			</div>	
			<!---------------- Da Text Field -------------------->
						
			
			<div class="content_button">
				<button type="button" class="btn btn-primary-mod">Apply Change</button>
			</div>
		</div>
	</div>
</form>
@stop