<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('cdn/font-awesome/all.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    
   @yield('content')

    
<script src="{{asset('cdn/jquery.js')}}"></script>
<script src="{{asset('cdn/popper.js')}}"></script>
<script src="{{asset('cdn/bootstrap.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>

</body>
</html>