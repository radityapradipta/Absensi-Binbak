@extends('layouts.main')
<div class="page_content">
    <div class="tableed">
        <div class="celled">
            <div class="rubirosa_logo_center">
                <span class="logo_center"></span>
            </div>
        </div>
    </div>	
</div>
@section('content')
<div class="page_title">
    <div class="tableed">
        <div class="celled">		
            <div class="page_content">
                <div class="head_logo">
                    <img src="{{ asset('assets/img/logo.png') }}">
                </div>

                <div class="head_title">
                    <h2>SISTEM ABSENSI BINA BAKTI</h2>
                </div>
            </div>
        </div>	
    </div>
</div>

<div class="login_content">
    <form>
        <input type="input" class="content_text_field" placeholder="Username"/ style="display:block;">
               <input type="password" class="content_text_field" placeholder="Password"/ style="display:block;">
               <div class="content_button">
            <button type="button" class="btn btn-primary-mod">Login</button>
        </div>
    </form>
</div>
@stop