<!doctype html>
<html lang="en">
<head>
    <base href="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf" content="{{ csrf_token() }}">
    <title>E-Commerce</title>

    <link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('public/css/front.css') }}">
</head>
<body>
    <div class="container-fluid">

        <div class="row min-vh-100">

            @include('front.includes.header')

            @yield('content')

            @include('front.includes.footer')
            
        </div>

    </div>

    @include('front.includes.messages')

    <script type="text/javascript" src="{{ url('public/js/front.js') }}"></script>
</body>
</html>