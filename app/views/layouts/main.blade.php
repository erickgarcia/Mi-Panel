<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">
    <title>@yield('title')</title>
    @section('head')
        <!-- Bootstrap -->
        {{ HTML::style('css/bootstrap.css') }}
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @show
</head>
<body>
@if(Session::has('global'))
    <p>{{ Session::get('global') }}</p>
@endif
@include('layouts.partials._navigation')
@yield('body')
@section('script')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('js/jquery.min.js') }}
    <!-- Include all compiled plugins -->
    {{ HTML::script('js/bootstrap.min.js') }}
    <!-- Main javascript for app -->
    {{ HTML::script('js/main.js') }}
@show
</body>
</html>