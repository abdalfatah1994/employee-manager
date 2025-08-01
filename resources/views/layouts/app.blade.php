<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>نظام الموظفين</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">   
</head>
<body dir="rtl">
    <div class="container mt-5">
        @include('partials.alerts')
        @yield('content')
    </div>
</body>
</html>