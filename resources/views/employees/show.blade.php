@extends('layouts.app')

{{-- إضافة أنماط مخصصة لعرض مميزة --}}
@push('styles')
<style>
  /* استيراد خط "Cairo" */
  @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap');

  :root {
    --primary-color: #1f3a93;
    --secondary-color: #4a69bd;
    --accent-color: #60a3bc;
    --light-bg: #f5f6fa;
    --text-color: #2d3436;
    --font-family: 'Cairo', sans-serif;
  }

  body {
    background: var(--light-bg);
    font-family: var(--font-family);
    color: var(--text-color);
  }

  .container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 1rem;
  }

  .mb-3 {
    margin-bottom: 1rem !important;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    opacity: 0.9;
  }

  /* طباعة لطيفة */
  @media print {
    body * {
      visibility: hidden;
    }

    .container,
    .container * {
      visibility: visible;
    }

    .container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
    }
  }
</style>
@endpush

@section('content')
<div class="container">
  {{-- جدول التفاصيل --}}
  <table class="table_custom">
    <caption style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">تفاصيل الموظف / Employee Details</caption>
    <tbody>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الرقم / ID</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->id }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الاسم الكامل / Full Name</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->first_name }} {{ $employee->last_name }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الرتبة / Rank</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->rank }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">البريد الإلكتروني / Email</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">
          <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
        </td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">رقم الهاتف / Phone</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">
          <a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a>
        </td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">المدينة / City</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->city }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">القسم / Department</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->department }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الراتب / Salary</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ number_format($employee->salary, 2, '.', ',') }} $</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الوصف / Description</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->description ?? '—' }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">تاريخ الإضافة / Created At</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->created_at->format('Y-m-d H:i') }}</td>
      </tr>
      <tr>
        <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">آخر تعديل / Updated At</th>
        <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->updated_at->format('Y-m-d H:i') }}</td>
      </tr>
    </tbody>
  </table>
  <div class="mb-3">
    <h4 style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">التعليقات / Comments</h4>
    @if($comments->isEmpty())
    <p class="text-muted" style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">لا توجد تعليقات حالياً / No comments yet</p>
    @else
    @foreach($comments as $comment)
    <div class="mb-3" style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">
      <strong>{{ $comment->author }}</strong>
      <span class="text-secondary" style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">— {{ $comment->created_at->diffForHumans() }}</span>
      <p style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $comment->body }}</p>
    </div>
    @endforeach
    @endif
  </div>
<hr><br>
  {{-- أزرار الرجوع والطباعة --}}
  <div class="text-right">
    <button onclick="window.print()" class="btn-primary"  style=" font-size: 24px;margin: 15px ;padding: 15px 5px;">🖨 طباعة / Print</button><br>
    <a href="{{ route('employees.index') }}" class="btn-primary"  style=" font-size: 24px;margin: 10px ;padding: 10px;text-decoration: none;"> رجوع للصفحة الرئيسية / Back to home</a>
  </div>
</div>
@endsection