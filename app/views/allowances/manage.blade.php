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
                <select class="content_dropDown" id="allowance-select"/>
					<option value="-1" disabled selected>Select Unit</option>
					@foreach ($departments as $department)	
						@if(isset($dept) && $department['id']==$dept->id)
							<option value="{{ $department['id'] }}" selected>{{ $department['name'] }}</option>
						@else
							<option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
						@endif	
					@endforeach
                </select>
            </div>
            <!---------------- Da Text Field -------------------->

        </div>
        <div class="page_content_right">
            @if(!isset($dept))
            <div class="content_head">Please insert the option :)</div>		
            @else
            <input type="hidden" value="{{ $dept->id }}" id="dept-id">
            <!---------------- Da Text Field -------------------->
            <div class="content_head">
                Weekday Allowance
            </div>

            <div class="content_field">
                <input type="input" class="content_text_field" value="{{ $dept->allowance->weekday_nominal }}" id="weekday_nominal">
            </div>	
            <!---------------- Da Text Field -------------------->

            <!---------------- Da Text Field -------------------->
            <div class="content_head">
                Weekend Allowance
            </div>

            <div class="content_field">
                <input type="input" class="content_text_field" value="{{ $dept->allowance->weekend_nominal }}" id="weekend_nominal">
            </div>	
            <!---------------- Da Text Field -------------------->

            <!---------------- Da Text Field -------------------->
            <div class="content_head">
                Cut Allowance
            </div>

            <div class="content_field">
                <input type="input" class="content_text_field" value="{{ $dept->allowance->cut_nominal }}" id="cut_nominal">
            </div>	
            <!---------------- Da Text Field -------------------->

            <div class="content_button">
                <button type="button" class="btn btn-primary-mod" id="allowance-save">Apply Change</button> 
            </div>		
            <br/><div class="alert" id="allowance-save-message"></div>
            @endif
        </div>
    </div>
</form>
@stop