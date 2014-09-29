@extends('layout.main')

@section('content')
	<div class="page_title">
		View Allowance
	</div>
	
	<div class="page_content">
		<div class="page_content_left">
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Select Month
			</div>
			
			<div class="content_field">
				<form>
					<select class="content_dropDown"/>
						<option value="jan">January</option>
						<option value="feb">February</option>
						<option value="mar">March</option>
						<option value="apr">April</option>
						<option value="may">May</option>
						<option value="jun">June</option>
						<option value="jul">July</option>
						<option value="aug">August</option>
						<option value="sep">September</option>
						<option value="nov">November</option>
						<option value="oct">October</option>
						<option value="dec">December</option>
					</select>
				</form>
			</div>
			<!---------------- Da Text Field -------------------->
			
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Select Unit
			</div>
			
			<div class="content_field">
				<form>
					<select class="content_dropDown"/>
						<option value="u1">Unit #1</option>
						<option value="u2">Unit #2</option>
						<option value="u3">Unit #3</option>
						<option value="u4">Unit #4</option>
						<option value="u5">Unit #5</option>
					</select>
				</form>
			</div>
			<!---------------- Da Text Field -------------------->
		
			<div class="content_button">
				<button type="button" class="btn btn-primary-mod">Display Form</button>
			</div>
		</div>
		
		<div class="page_content_right">
			<!---------------- Da Text Field -------------------->
			
			<div class="content_head">
				Select Year
			</div>
			
			<div class="content_field">
				<form>
					<select class="content_dropDown"/>
						<option value="jan">2010</option>
						<option value="feb">2011</option>
						<option value="mar">2012</option>
						<option value="apr">2013</option>
						<option value="may">2014</option>
					</select>
				</form>
			</div>
			
			<!---------------- Da Text Field -------------------->
		</div>
	</div>
@stop