<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('ums.sports.sports-meta.header')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    
    @include('ums.sports.sports-meta.sidebar')
    @include('ums.sports.sports-meta.navbar')

    @yield('content')
    @include('ums.sports.sports-meta.footer')
    @include('ums.sports.sports-meta.script')


    
</body>
</html>