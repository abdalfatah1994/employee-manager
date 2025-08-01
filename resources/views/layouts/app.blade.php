<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>نظام الموظفين</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body dir="rtl">
    <div class="container mt-5">
        @include('partials.alerts')
        @yield('content')
    </div>
</body>
</html>