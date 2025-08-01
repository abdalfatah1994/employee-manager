<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME PAGE</title>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f5f6fa 0%, #e0e7ff 100%);
            font-family: 'Instrument Sans', sans-serif;
            color: #1b1b18;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .main-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(76,110,245,0.08);
            padding: 2.5rem 2rem;
            max-width: 420px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px);}
            to   { opacity: 1; transform: none;}
        }
        h1 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #4a69bd;
            letter-spacing: 1px;
        }
        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }
        .nav-link {
            background: linear-gradient(90deg, #4a69bd 0%, #60a3bc 100%);
            color: #fff;
            font-size: 1.15rem;
            font-weight: 500;
            text-decoration: none;
            padding: .75rem 1.5rem;
            border-radius: .5rem;
            box-shadow: 0 2px 8px rgba(76,110,245,0.07);
            transition: background .2s, transform .1s;
        }
        .nav-link:hover {
            background: linear-gradient(90deg, #60a3bc 0%, #4a69bd 100%);
            transform: scale(1.04);
            opacity: 0.95;
        }
        @media (max-width: 600px) {
            .main-card { padding: 1.2rem .5rem; }
            h1 { font-size: 1.4rem; }
            .nav-link { font-size: 1rem; padding: .5rem 1rem; }
        }
    </style>
</head>

<body>
    <div class="main-card">
        <h1>Welcome to the Employee Manager</h1>
        <h1>اهلا وسهلا بك في الصفحة الرئيسية</h1>
        <div class="nav-links">
            <a href="{{ route('employees.index') }}" class="nav-link">عرض الموظفين / Employees List</a>
            <a href="{{ route('employees.create') }}" class="nav-link">إضافة موظف جديد / Add Employee</a>
        </div>
    </div>
</body>

</html>