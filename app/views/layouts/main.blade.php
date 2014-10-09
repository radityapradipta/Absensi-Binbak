<!DOCTYPE html>
<html lang="en">
    <head>		
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Normalize -->
        {{ HTML::style('assets/css/normalize.css') }}

        <!-- Bootstrap -->
        {{ HTML::style('assets/css/bootstrap.min.css') }}

        <!-- Bootstrap Custom -->
        {{ HTML::style('assets/css/bootstrap_custom.css') }}

        <!-- Custom -->
        {{ HTML::style('assets/css/custom_style_00.css') }}

        {{ HTML::style('assets/css/fluid_grid.css') }}
        {{ HTML::style('assets/css/uploadfile.min.css') }}
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
                    <li><a href="{{ URL::to('user/manage') }}">MANAGE USER</a></li>
                    <li><a href="{{ URL::to('converter') }}">CONVERT DOCUMENT</a></li>
                    <li><a href="{{ URL::to('user/edit') }}">EDIT PROFILE</a></li>
                </ul>
            </section>

            <section class="main_content_wrapper">
                @yield('content')
            </section>
        </section>
        {{ HTML::script('assets/js/jquery-1.11.1.min.js') }}
        {{ HTML::script('assets/js/modal.js') }}
        {{ HTML::script('assets/js/jquery.form.js') }}
        {{ HTML::script('assets/js/jquery.uploadfile.min.js') }}
        {{ HTML::script('js/custom.js') }}
    </body>
</html>	