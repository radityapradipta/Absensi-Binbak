@extends('layouts.main')

@section('content')
<div class="page_title">
    Manage Allowance
</div>
<form>
    <div class="page_content">
        <div class="page_content_left">
            <!---------------- Da Text Field -------------------->

            <div class="content_head">
                Select Allowance Category
            </div>

            <div class="content_field">
                <select class="content_dropDown" id="allowance-select"/>
                <option value="-1" disabled selected>Select Allowance Category</option>
                @foreach ($allowances as $allowance)	
                @if(isset($allow) && $allowance['id']==$allow->id)
                <option value="{{ $allowance['id'] }}" selected>{{ $allowance['information'] }}</option>
                @else
                <option value="{{ $allowance['id'] }}">{{ $allowance['information'] }}</option>
                @endif	
                @endforeach
                </select>
            </div>
            <!---------------- Da Text Field -------------------->

        </div>
        <div class="page_content_right">
            @if(!isset($allow))
            <div class="content_head">Please insert the option :)</div>		
            @else
            <input type="hidden" value="{{ $allow->id }}" id="dept-id">
            <!---------------- Da Text Field -------------------->
            <div class="content_head">
                Weekday Allowance
            </div>

            <div class="content_field">
                <input type="input" class="content_text_field" value="{{ $allow->weekday_nominal }}" id="weekday_nominal">
            </div>	
            <!---------------- Da Text Field -------------------->

            <!---------------- Da Text Field -------------------->
            <div class="content_head">
                Weekend Allowance
            </div>

            <div class="content_field">
                <input type="input" class="content_text_field" value="{{ $allow->weekend_nominal }}" id="weekend_nominal">
            </div>	
            <!---------------- Da Text Field -------------------->

            <!---------------- Da Text Field -------------------->
            <div class="content_head">
                Cut Allowance
            </div>

            <div class="content_field">
                <input type="input" class="content_text_field" value="{{ $allow->cut_nominal }}" id="cut_nominal">
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