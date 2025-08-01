{{-- resources/views/employees/index.blade.php --}}
@extends('layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap');

    :root {
        --primary-color: #2c3e50;
        --secondary-color: #18bc9c;
        --light-bg: #f0f4f8;
        --accent-color: #3498db;
        --danger-color: #e74c3c;
        --font-family: 'Cairo', sans-serif;
    }

    body {
        background-color: var(--light-bg);
        font-family: var(--font-family);
        color: var(--primary-color);
        padding: 1rem;
    }

    .btn-primary {
        background: linear-gradient(45deg, var(--secondary-color), var(--accent-color));
        padding: 2px;
        margin: 8px;
        border-radius: 5px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        transition: transform .1s ease, opacity .2s ease;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .table-custom caption {
        background: linear-gradient(45deg, var(--accent-color), var(--secondary-color));
        padding: .75rem 1rem;
        width: 100%;
        font-size: 20px;
        font-weight: 800;
        border-collapse: collapse;
        border-radius: 8px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .table-custom th,
    .table-custom td {
        border: 3px solid black;
        padding: .75rem 1rem;
    }

    .table-custom thead th {
        background: var(--secondary-color);
        color: #fff;
        font-weight: 600;
        text-align: center;
        padding: .75rem 1rem;
    }

    .table-custom tbody td {
        padding: .75rem 1rem;
        text-align: center;
        border-bottom: 1px solid #e0e4e8;
    }

    .table-custom tbody tr:nth-child(even) {
        background: #f9fbfc;
    }

    .table-custom tbody tr:hover {
        background: #eef6f5;
    }

    .btn-sm {
        background: linear-gradient(45deg, var(--secondary-color), var(--accent-color));
        padding: 2px;
        margin: 5px;
        border-radius: 5px;
        font-weight: 600;
        text-decoration: none;
        font-size: .85rem;
        transition: background-color .2s ease;
    }

    .btn-warning {
        background: #f39c12;
        color: #fff;
    }

    .btn-danger {
        background: var(--danger-color);
        color: #fff;
        border: none;
    }

    .btn-info {
        background: var(--accent-color);
        color: #fff;
        border: none;
    }

    .pagination {
        justify-content: center;
        margin-top: 1rem;
    }

    .page-item.active .page-link {
        background: var(--secondary-color);
        border-color: var(--secondary-color);
        color: #fff;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }
</style>


<table class="table-custom">
    <caption> جدول عرض الموظفين / Employees data table</caption>
    <thead>
        <tr>
            <th>الاسم الكامل <br> Full Name</th>
            <th>الرتبة <br> Rank</th>
            <th>البريد الإلكتروني <br> Email</th>
            <th>الهاتف <br> Phone</th>
            <th>المدينة <br> City</th>
            <th>القسم <br> Department</th>
            <th>الراتب الشهري <br> Salary</th>
            <th colspan="3">الإجراءات / Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $emp)
        <tr>
            <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
            <td>{{ $emp->rank }}</td>
            <td>{{ $emp->email }}</td>
            <td>{{ $emp->phone }}</td>
            <td>{{ $emp->city }}</td>
            <td>{{ $emp->department }}</td>
            <td>{{ number_format($emp->salary, 2) }} $</td>
            <td>
                <a href="{{ route('employees.edit', $emp) }}" class="btn btn-sm btn-warning">
                    تعديل / Edit
                </a>
            </td>

            <td>
                <form
                    action="{{ route('employees.destroy', $emp) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الموظف؟ / Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        حذف / Delete
                    </button>
                </form>
            </td>

            <td>
                <a href="{{ route('employees.show', $emp) }}" class="btn btn-sm btn-info">
                    تفاصيل / Details
                </a>
            </td>
            @endforeach
    </tbody>
</table>
<br>
{{-- زر إضافة موظف جديد / Add New Employee button --}}
<a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">
    إضافة موظف جديد / Add New Employee
</a>
{{ $employees->links() }}

@endsection