{{-- resources/views/employees/edit.blade.php --}}
@extends('layouts.app')

@section('content')

  {{-- inline CSS خاص بالصفحة --}}
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap');
    :root {
      --primary:   #2c3e50;
      --accent:    #18bc9c;
      --light-bg:  #f7f9fa;
      --error:     #e74c3c;
      --font:      'Cairo', sans-serif;
    }
    body { background: var(--light-bg); font-family: var(--font); color: var(--primary); }
    .card { border-radius: .5rem; box-shadow: 0 4px 8px rgba(0,0,0,.05); margin: 1.5rem 0; }
    .card-header {
      background: #fff; padding: 1rem 1.5rem;
      font-size: 1.25rem; font-weight: 600;
      border-bottom: 1px solid #e0e4e8;
    }
    .card-body { padding: 1.5rem; background: #fff; }
    .card-footer {
      background: #fff; padding: 1rem 1.5rem;
      border-top: 1px solid #e0e4e8; text-align: left;
    }
    .form-group { margin-bottom: 1rem; }
    .form-control {
      width: 100%; padding: .5rem .75rem;
      border: 1px solid #ced4da; border-radius: .25rem;
      transition: border-color .15s ease, box-shadow .15s ease;
    }
    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 5px rgba(24,188,156,.5);
      outline: none;
    }
    .is-invalid { border-color: var(--error) !important; }
    .invalid-feedback { color: var(--error); font-size: .875rem; margin-top: .25rem; }
    .btn {
      display: inline-block; font-weight: 600;
      padding: .5rem 1rem; border: none; border-radius: .25rem;
      cursor: pointer; transition: background .2s ease;
    }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: #17a589; }
    .btn-secondary { background: #bdc3c7; color: var(--primary); }
    .btn-secondary:hover { background: #aab7b8; }

    @media (min-width: 768px) {
      .col-md-6 { width: 50%; padding: 0 .5rem; }
      .col-md-4 { width: 33.333%; padding: 0 .5rem; }
    }
    @media (max-width: 767px) {
      .col-md-6, .col-md-4 { width: 100%; padding: 0 .5rem; }
    }
  </style>


  <div class="card">
    <div class="card-header">
      تعديل بيانات الموظف / Edit Employee
    </div>

    <div class="card-body">
      {{-- رسالة النجاح --}}
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('employees.update', $employee) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="row">
          {{-- الاسم الأول / First Name --}}
          <div class="form-group col-md-6">
            <label for="first_name">الاسم الأول / First Name</label>
            <input
              type="text"
              id="first_name"
              name="first_name"
              placeholder="أدخل الاسم الأول / Enter first name"
              class="form-control @error('first_name') is-invalid @enderror"
              value="{{ old('first_name', $employee->first_name) }}"
            >
            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- الاسم الأخير / Last Name --}}
          <div class="form-group col-md-6">
            <label for="last_name">الاسم الأخير / Last Name</label>
            <input
              type="text"
              id="last_name"
              name="last_name"
              placeholder="أدخل الاسم الأخير / Enter last name"
              class="form-control @error('last_name') is-invalid @enderror"
              value="{{ old('last_name', $employee->last_name) }}"
            >
            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="row">
          {{-- الرتبة / Rank --}}
          <div class="form-group col-md-4">
            <label for="rank">الرتبة / Rank</label>
            <select
              id="rank"
              name="rank"
              class="form-control @error('rank') is-invalid @enderror"
            >
              <option value="" disabled {{ old('rank',$employee->rank)==''? 'selected':'' }}>
                اختر الرتبة / Select rank
              </option>
              <option value="موظف"     {{ old('rank',$employee->rank)=='موظف'?     'selected':'' }}>موظف / Employee</option>
              <option value="رئيس قسم" {{ old('rank',$employee->rank)=='رئيس قسم'? 'selected':'' }}>رئيس قسم / Team Lead</option>
              <option value="مدير"     {{ old('rank',$employee->rank)=='مدير'?     'selected':'' }}>مدير / Manager</option>
            </select>
            @error('rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- البريد الإلكتروني / Email --}}
          <div class="form-group col-md-4">
            <label for="email">البريد الإلكتروني / Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="example@domain.com"
              class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email', $employee->email) }}"
            >
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- رقم الهاتف / Phone --}}
          <div class="form-group col-md-4">
            <label for="phone">رقم الهاتف / Phone</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              placeholder="009639xxxxxxxx"
              class="form-control @error('phone') is-invalid @enderror"
              value="{{ old('phone', $employee->phone) }}"
            >
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="row">
          {{-- المدينة / City --}}
          <div class="form-group col-md-4">
            <label for="city">المدينة / City</label>
            <input
              type="text"
              id="city"
              name="city"
              placeholder="أدخل اسم المدينة / Enter city"
              class="form-control @error('city') is-invalid @enderror"
              value="{{ old('city', $employee->city) }}"
            >
            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- القسم / Department --}}
          <div class="form-group col-md-4">
            <label for="department">القسم / Department</label>
            <input
              type="text"
              id="department"
              name="department"
              placeholder="مثال: الموارد البشرية / e.g. HR"
              class="form-control @error('department') is-invalid @enderror"
              value="{{ old('department', $employee->department) }}"
            >
            @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- الراتب الشهري / Salary --}}
          <div class="form-group col-md-4">
            <label for="salary">الراتب الشهري / Salary</label>
            <input
              type="number"
              step="0.01"
              id="salary"
              name="salary"
              placeholder="أدخل الراتب / Enter salary"
              class="form-control @error('salary') is-invalid @enderror"
              value="{{ old('salary', $employee->salary) }}"
            >
            @error('salary')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        {{-- الوصف الوظيفي / Short Description --}}
        <div class="form-group">
          <label for="description">وصف مختصر / Short Description</label>
          <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="أضف وصفًا مختصرًا / Enter a short description"
            class="form-control @error('description') is-invalid @enderror"
          >{{ old('description', $employee->description) }}</textarea>
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
            حفظ التعديلات / Save Changes
          </button>
          <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            العودة / Back
          </a>
        </div>
      </form>
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

    </div>
  </div>

@endsection