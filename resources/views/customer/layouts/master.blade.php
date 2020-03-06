<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" href="{{asset('test-image/cart-icon.png')}}"/>
    <link rel="stylesheet" href="{{ asset('cdn/font-awesome/all.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables.css')}}">
    <link rel="stylesheet" href="{{ asset('css/customer.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>

    
   @yield('content')

 
<script src="{{asset('cdn/jquery.js')}}"></script>
<script src="{{asset('cdn/popper.js')}}"></script>
<script src="{{asset('cdn/bootstrap.js')}}"></script>
<script src="{{asset('cdn/datatables.js')}}"></script>
<script src="{{asset('cdn/boot_datatables.js')}}"></script>
<script src="{{asset('js/customer.js')}}"></script>

</body>
</html>