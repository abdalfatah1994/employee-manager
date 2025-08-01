{{-- ...existing code... --}}
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');

    :root {
      --primary-color:   #2c3e50;
      --secondary-color: #18bc9c;
      --accent-color:    #6366f1;
      --light-color:     #f6f8fa;
      --danger-color:    #e74c3c;
      --font-family:     'Tajawal', sans-serif;
    }

    body {
      background: linear-gradient(120deg, var(--light-color) 0%, #e0e7ff 100%);
      font-family: var(--font-family);
      color: var(--primary-color);
      line-height: 1.7;
      min-height: 100vh;
    }

    .card {
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 8px 32px rgba(99,102,241,0.08);
      margin-bottom: 2rem;
      border: none;
      overflow: hidden;
      animation: fadeIn 0.7s;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px);}
      to   { opacity: 1; transform: none;}
    }

    .card-header {
      padding: 1.5rem 2rem;
      background: linear-gradient(90deg, var(--secondary-color) 0%, var(--accent-color) 100%);
      color: #fff;
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: 1px;
      border-bottom: none;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .card-header::before {
      content: "\f007";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      margin-left: 8px;
      font-size: 1.3em;
      opacity: 0.7;
    }

    .card-body { padding: 2rem; background: #fff; }
    .card-footer { padding: 1.5rem 2rem; background: var(--light-color); border-top: 1px solid #eaeaea; text-align: left; }

    .form-group { margin-bottom: 1.5rem; }
    label {
      font-weight: 500;
      color: var(--accent-color);
      margin-bottom: .5rem;
      display: block;
      letter-spacing: .5px;
    }
    input.form-control,
    select.form-control,
    textarea.form-control {
      width: 100%;
      padding: .75rem 1rem;
      border: 1px solid #d1d5db;
      border-radius: .5rem;
      background: #f3f4f6;
      font-size: 1rem;
      transition: border-color .2s, box-shadow .2s;
      box-shadow: 0 2px 8px rgba(99,102,241,0.03);
    }

    input.form-control:focus,
    select.form-control:focus,
    textarea.form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 8px rgba(99,102,241,.15);
      outline: none;
      background: #fff;
    }

    .invalid-feedback { font-size: .95rem; color: var(--danger-color); margin-top: .25rem; }

    .btn {
      display: inline-block;
      font-weight: 700;
      text-align: center;
      border: none;
      border-radius: .5rem;
      padding: .75rem 2rem;
      font-size: 1.1rem;
      margin-right: 1rem;
      box-shadow: 0 2px 8px rgba(99,102,241,0.07);
      transition: background .2s, transform .1s;
      cursor: pointer;
    }

    .btn-success {
      background: linear-gradient(90deg, var(--secondary-color) 0%, var(--accent-color) 100%);
      color: #fff;
    }
    .btn-success:hover {
      background: linear-gradient(90deg, var(--accent-color) 0%, var(--secondary-color) 100%);
      transform: scale(1.04);
    }
    .btn-secondary {
      background: #e0e7ff;
      color: var(--primary-color);
    }
    .btn-secondary:hover {
      background: #c7d2fe;
      transform: scale(1.04);
    }

    body[dir="ltr"] input,
    body[dir="ltr"] select,
    body[dir="ltr"] textarea {
      direction: ltr;
    }

    .row { display: flex; flex-wrap: wrap; margin: -0.5rem; }
    [class*="col-md-"] { padding: 0.5rem; }

    @media (min-width: 768px) {
      .col-md-6 { width: 50%; }
      .col-md-4 { width: 33.333%; }
    }

    @media (max-width: 767px) {
      [class*="col-md-"] { width: 100%; }
      .card-header, .card-footer { text-align: center; }
    }
  </style>
{{-- ...existing code... --}}


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
      <a href="{{ route('views-welcome') }}" class="btn btn-secondary">
        الذهاب الى الصفحة الرئيسية / Go home page
      </a>
      
    </div>
  </form>
  <p>$siteName</p>
</div>