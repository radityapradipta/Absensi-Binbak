@extends('layouts.main')

@section('content')
<br class="clear"/><br/><br/><br/>
<div style="width:75%;display:block;text-align:center;">
    <div class="head_logo">
        {{ HTML::image('assets/img/logo.png') }}
    </div>
    <div class="head_title">
        <h2>SISTEM INFORMASI ABSENSI BINA BAKTI</h2>
    </div>
</div>	

<br class="clear"/><br/>
<div class="page_title">
    Welcome, {{ ucfirst(Auth::user()->username) }} &nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
</div>
@stop