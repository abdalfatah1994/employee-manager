{{-- resources/views/employees/form.blade.php --}}
@extends('layouts.app')
@section('content') 
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');

    :root {
      --primary-color:   #2c3e50;
      --secondary-color: #18bc9c;
      --light-color:     #ecf0f1;
      --danger-color:    #e74c3c;
      --font-family:     'Tajawal', sans-serif;
    }

    body {
      background-color: var(--light-color);
      font-family: var(--font-family);
      color: var(--primary-color);
      line-height: 1.6;
    }

    .card {
      background: #fff;
      border-radius: .5rem;
      box-shadow: 0 4px 8px rgba(0,0,0,.05);
      margin-bottom: 1.5rem;
    }

    .card-header {
      padding: 1rem 1.5rem;
      background: var(--light-color);
      border-bottom: 1px solid #eaeaea;
      font-size: 1.25rem;
      font-weight: 600;
    }

    .card-body { padding: 1.5rem; }
    .card-footer { padding: 1rem 1.5rem; background: var(--light-color); }

    .form-group { margin-bottom: 1rem; }
    input.form-control,
    select.form-control,
    textarea.form-control {
      width: 100%;
      padding: .5rem .75rem;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color .15s ease, box-shadow .15s ease;
    }

    input.form-control:focus,
    select.form-control:focus,
    textarea.form-control:focus {
      border-color: var(--secondary-color);
      box-shadow: 0 0 5px rgba(24,188,156,.5);
      outline: none;
    }

    .invalid-feedback { font-size: .875rem; color: var(--danger-color); }

    .btn {
      display: inline-block;
      font-weight: 600;
      text-align: center;
      border: none;
      border-radius: .25rem;
      padding: .5rem 1rem;
      transition: transform .1s ease;
      cursor: pointer;
    }

    .btn-success { background: var(--secondary-color); color: #fff; }
    .btn-success:hover { background: #17a589; }
    .btn-secondary { background: #bdc3c7; color: var(--primary-color); }
    .btn-secondary:hover { background: #aab7b8; }

    body[dir="rtl"] input,
    body[dir="rtl"] select,
    body[dir="rtl"] textarea {
      direction: rtl;
    }

    .row { display: flex; flex-wrap: wrap; margin: -0.5rem; }
    [class*="col-md-"] { padding: 0.5rem; }

    @media (min-width: 768px) {
      .col-md-6 { width: 50%; }
      .col-md-4 { width: 33.333%; }
    }

    @media (max-width: 767px) {
      [class*="col-md-"] { width: 100%; }
    }
  </style>

  <div class="card shadow-sm">
    {{-- عنوان البطاقة يُغيّر تبعًا لوضع الإضافة أو التعديل / Dynamic card header --}}
    <div class="card-header">
      {{ isset($employee) 
          ? 'تعديل بيانات الموظف / Edit Employee' 
          : 'إضافة موظف جديد / Add New Employee' }}
    </div>

    <div class="card-body">
      <form
        action="{{ isset($employee)
                  ? route('employees.update', $employee)  {{-- عند التعديل: يوجّه إلى مسار التحديث --}}
                  : route('employees.store') }}"          {{-- عند الإضافة: يوجّه إلى مسار الإنشاء --}}
        method="POST"
        novalidate {{-- منع تحقق المتصفح الافتراضي --}}
      >
        @csrf        {{-- توكين الحماية من هجمات CSRF --}}
        @isset($employee)
          @method('PUT') {{-- تحويل الطلب إلى PUT عند وجود الموظف للتحرير --}}
        @endisset

        <div class="row">
          {{-- حقل الاسم الأول / First Name --}}
          <div class="form-group col-md-6">
            <label for="first_name">الاسم الأول / First Name</label>
            <input
              type="text"
              id="first_name"
              name="first_name"
              placeholder="أدخل الاسم الأول / Enter first name"
              class="form-control @error('first_name') is-invalid @enderror"
              value="{{ old('first_name', $employee->first_name ?? '') }}"
            >
            @error('first_name')
              <div class="invalid-feedback">{{ $message }}</div> {{-- إظهار رسالة الخطأ --}}
            @enderror
          </div>

          {{-- حقل الاسم الأخير / Last Name --}}
          <div class="form-group col-md-6">
            <label for="last_name">الاسم الأخير / Last Name</label>
            <input
              type="text"
              id="last_name"
              name="last_name"
              placeholder="أدخل الاسم الأخير / Enter last name"
              class="form-control @error('last_name') is-invalid @enderror"
              value="{{ old('last_name', $employee->last_name ?? '') }}"
            >
            @error('last_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

          {{-- حقل الرتبة الوظيفية / Rank --}}
          <div class="form-group col-md-4">
            <label for="rank">الرتبة / Rank</label>
            <select
              id="rank"
              name="rank"
              class="form-control @error('rank') is-invalid @enderror"
            >
              <option value="" disabled {{ old('rank', $employee->rank ?? '') == '' ? 'selected' : '' }}>
                اختر الرتبة / Select rank
              </option>
              <option value="employee / موظف"     {{ old('rank', $employee->rank ?? '') == 'Employee / موظف'     ? 'selected' : '' }}>موظف / Employee</option>
              <option value="رئيس قسم / Team Lead" {{ old('rank', $employee->rank ?? '') == 'رئيس قسم / Team Lead' ? 'selected' : '' }}>رئيس قسم / Team Lead</option>
              <option value="مدير / Manager"     {{ old('rank', $employee->rank ?? '') == 'مدير / Manager'     ? 'selected' : '' }}>مدير / Manager</option>
            </select>
            @error('rank')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- حقل البريد الإلكتروني / Email --}}
          <div class="form-group col-md-4">
            <label for="email">البريد الإلكتروني / Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="example@domain.com"
              class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email', $employee->email ?? '') }}"
            >
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- حقل رقم الهاتف / Phone --}}
          <div class="form-group col-md-4">
            <label for="phone">رقم الهاتف / Phone</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              placeholder="009639xxxxxxxx"
              class="form-control @error('phone') is-invalid @enderror"
              value="{{ old('phone', $employee->phone ?? '') }}"
            >
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- حقل المدينة / City --}}
          <div class="form-group col-md-4">
            <label for="city">المدينة / City</label>
            <input
              type="text"
              id="city"
              name="city"
              placeholder="أدخل اسم المدينة / Enter city"
              class="form-control @error('city') is-invalid @enderror"
              value="{{ old('city', $employee->city ?? '') }}"
            >
            @error('city')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- حقل القسم / Department --}}
       <div class="form-group col-md-4">
            <label for="department">القسم / Department</label>
            <input
              type="text"
              id="department"
              name="department"
              placeholder="مثال: الموارد البشرية / e.g. HR"
              class="form-control @error('department') is-invalid @enderror"
              value="{{ old('department', $employee->department ?? '') }}"
            >
            @error('department')
           <div class="invalid-feedback">{{ $message }}</div>
            @enderror

          {{-- حقل الراتب الشهري / Salary --}}
          <div class="form-group col-md-4">
            <label for="salary">الراتب الشهري / Salary</label>
            <input
              type="number"
              step="0.01"
              id="salary"
              name="salary"
              placeholder="أدخل الراتب / Enter salary"
              class="form-control @error('salary') is-invalid @enderror"
              value="{{ old('salary', $employee->salary ?? '') }}"
            >
            @error('salary')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- حقل الوصف الوظيفي / Description --}}
        <div class="form-group">
          <label for="description">وصف مختصر / Short Description</label>
          <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="أضف وصفًا مختصرًا لمهام هذا الموظف / Enter a short description"
            class="form-control @error('description') is-invalid @enderror"
          >{{ old('description', $employee->description ?? '') }}</textarea>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- أزرار الإرسال والإلغاء / Submit & Cancel buttons --}}
        <div class="card-footer">
          <button type="submit" class="btn btn-success">
            {{ isset($employee) ? 'حفظ التعديلات / Save Changes' : 'إضافة موظف / Add Employee' }}
          </button>
          <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            إلغاء / Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection