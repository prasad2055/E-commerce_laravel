<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ url('/') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} CMS</title>
    <link rel="stylesheet" href="{{ url('public/css/back.css') }}">
</head>
<body>

    @auth('cms')
    @include('back.includes.nav')
    @endauth

    @yield('content')

    @include('back.includes.messages')

    <script src="{{ url('public/js/back.js') }}"></script>
</body>
</html>