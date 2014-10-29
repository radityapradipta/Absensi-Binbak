@extends('layouts.main')

@section('content')
<div class="page_title">
    Convert Document
</div>
<div class="page_content">
    <div class="page_content_solo">
        <div id="fileuploader">Upload File Access</div>
        <div class="content_button">
            <button type="button" id="convert-button" class="btn btn-primary-mod">Convert File</button>
        </div>
    </div>

    <div class="page_content_under">
        <img id="loading" src="{{ asset('assets/img/LoadingCircle.gif') }}" style="display:none" />
        <!--<span class="alert alert-danger" role="alert" style=""></span>-->
    </div>
</div>
@stop