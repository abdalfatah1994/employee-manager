@extends('layouts.app')
@section('title', 'تفاصيل الموظف / Employee Details')
@section('content')
<div class="container">
  {{-- جدول التفاصيل --}}
  <h1 style=" text-align: center;margin: 20px;padding: 20px;">تفاصيل الموظف / Employee Details</ا>
    <table class="table_custom">
      <tbody>
        <tr>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الرقم / ID</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->id }}</td>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الاسم الكامل / Full Name</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->first_name }} {{ $employee->last_name }}</td>
        </tr>
        <tr>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الرتبة / Rank</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->rank }}</td>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">البريد الإلكتروني / Email</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;"><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a></td>
        </tr>
        <tr>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">رقم الهاتف / Phone</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;"><a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a></td>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">المدينة / City</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->city }}</td>
        </tr>
        <tr>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">القسم / Department</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->department }}</td>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الراتب / Salary</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ number_format($employee->salary, 2, '.', ',') }} $</td>
        </tr>
        <tr>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">آخر تعديل / Updated At</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->updated_at->format('Y-m-d H:i') }}</td>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">تاريخ الإضافة / Created At</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        <tr>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">الوصف / Description</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">{{ $employee->description ?? '—' }}</td>
          <th style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;">التعليقات / Comments</th>
          <td style="border: 3px solid black; font-size: 24px;text-align: center;margin: 10px 5px;padding: 10px 5px;"> @if($comments->isEmpty())
            <p class="text-muted">لا توجد تعليقات حالياً / No comments yet</p>
            @else
            @foreach($comments as $comment)
            <div class="mb-3">
              <strong>{{ $comment->author }}</strong>
              <span class="text-secondary">— {{ $comment->created_at->diffForHumans() }}</span>
              <p>{{ $comment->body }}</p>
            </div>
            @endforeach
            @endif
          </td>
        </tr>
      </tbody>
    </table>
    <hr><br>
    {{-- أزرار الرجوع والطباعة --}}
    <span class="text-right">
      <a href="{{ route('employees.index') }}" class="btn-primary" style=" font-size: 24px;margin: 10px ;padding: 10px;text-decoration: none;"> رجوع للصفحة الرئيسية / Back to home</a>
      <button onclick="window.print()" class="btn-primary" style=" font-size: 24px;margin: 15px ;padding: 15px 5px;">🖨 طباعة / Print</button>
    </span>
</div>
@endsection