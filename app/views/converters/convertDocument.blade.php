@extends('layouts.main')

@section('content')
<form>
    <div class="page_title">
        Convert Document
    </div>

    <div class="page_content">
        <div class="page_content_solo">
            {{ Form::open(array('url'=>'form-submit','files'=>true)) }}
            {{-- Form::open(array('action'=>'ConverterController@execute','files'=>true)) --}}
            {{ Form::label('file','Unggah File Ms Access di sini') }}
            {{ Form::file('file') }}
            {{ Form::submit('Submit'); }} 
            {{ Form::close() }}

            <div class="content_button">
                <button type="button" id="convert-button" class="btn btn-primary-mod">Convert File</button>
            </div>
        </div>

        <div class="page_content_under">
            <img id="loading" src="{{ asset('assets/img/LoadingCircle.gif') }}" style="display:none" />
        </div>
    </div>
</form>
@stop