{{-- نموذج إضافة تعليق --}}
<form action="{{ route('comments.store') }}" method="POST" style="margin-bottom:2rem;">
    @csrf
    {{-- قائمة منسدلة لاختيار الموظف --}}
    <div class="form-group" style="margin-bottom:1rem;">
        <label for="employee_id">اختر الموظف / Select Employee</label>
        <select name="employee_id" id="employee_id" class="form-control" required>
            <option value="">-- اختر الموظف --</option>
            @foreach($allEmployees as $emp)
            <option value="{{ $emp->id }}" {{ (isset($employee) && $employee->id == $emp->id) ? 'selected' : '' }}>
                {{ $emp->first_name }} {{ $emp->last_name }} (ID: {{ $emp->id }})
            </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="author">اسمك / Your Name</label>
        <input type="text" name="author" id="author" class="form-control" required>
    </div>
    <div>
        <label for="body">التعليق / Comment</label>
        <textarea name="body" id="body" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top:1rem;">إرسال التعليق / Submit</button>
</form>
<hr><br>
<span class="text-right">
    <a href="{{ route('employees.index') }}" class="btn-primary" style=" font-size: 24px;margin: 10px ;padding: 10px;text-decoration: none;"> الرجوع لصفحة الموظفين / Back to employees</a>
    <button onclick="window.print()" class="btn-primary" style=" font-size: 24px;margin: 15px ;padding: 15px 5px;">🖨 طباعة / Print</button>
    <a href="{{ route('views-welcome') }}" class="btn btn-secondary"> الذهاب الى الصفحة الرئيسية / Go home page </a>
</span>