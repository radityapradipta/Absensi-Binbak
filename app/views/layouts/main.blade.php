<!DOCTYPE html>
<html lang="en">
    <head>		
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Normalize -->
        <link href="{{ asset('assets/css/normalize.css') }}" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Bootstrap Custom -->
        <link href="{{ asset('assets/css/bootstrap_custom.css') }}" rel="stylesheet">

        <!-- Custom -->
        <link href="{{ asset('assets/css/custom_style_00.css') }}" rel="stylesheet">
        <title>

        </title>
    </head>

    <body>
        <section class="wrapper">
            <section class="sidebar_nav_bar">
                <ul>
                    <li><a href="#" class="sidebar_brand">DASHBOARD</a></li>
                    <li><a href="{{ URL::to('allowance') }}">VIEW ALLOWANCE</a></li>
                    <li><a href="{{ URL::to('allowance/manage') }}">MANAGE ALLOWANCE</a></li>
                    <li><a href="{{-- URL::route('manage-user') --}}">MANAGE USER</a></li>
                    <li><a href="{{ URL::to('converter') }}">CONVERT DOCUMENT</a></li>
                    <li><a href="{{ URL::to('user/edit') }}">EDIT PROFILE</a></li>
                </ul>
            </section>

            <section class="main_content_wrapper">
                @yield('content')
            </section>
        </section>
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/custom.js') }}
    </body>
</html>	