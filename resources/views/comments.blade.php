<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap');

    body {
        background: linear-gradient(120deg, #f5f6fa 0%, #e0e7ff 100%);
        font-family: 'Cairo', sans-serif;
        color: #2c3e50;
        margin: 0;
        padding: 0;
    }

    .comment-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 32px rgba(76, 110, 245, 0.08);
        max-width: 500px;
        margin: 2rem auto;
        padding: 2rem 2rem 1.5rem 2rem;
        text-align: center;
        animation: fadeIn 0.7s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .comment-card h2 {
        color: #3498db;
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 1.2rem;
        text-align: left;
    }

    label {
        font-weight: 600;
        color: #18bc9c;
        margin-bottom: .5rem;
        display: block;
        font-size: 1.1rem;
    }

    select,
    input[type="text"],
    textarea {
        width: 100%;
        padding: .7rem;
        border-radius: .5rem;
        border: 1px solid #dbeafe;
        font-size: 1rem;
        margin-top: .2rem;
        background: #f8fafc;
        transition: border-color .2s;
    }

    select:focus,
    input:focus,
    textarea:focus {
        border-color: #3498db;
        outline: none;
    }

    .btn-primary {
        background: linear-gradient(90deg, #4a69bd 0%, #60a3bc 100%);
        color: #fff;
        border: none;
        border-radius: .5rem;
        font-size: 1.1rem;
        font-weight: 700;
        padding: .75rem 2rem;
        margin: 10px 0;
        box-shadow: 0 2px 8px rgba(76, 110, 245, 0.07);
        transition: background .2s, transform .1s;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #60a3bc 0%, #4a69bd 100%);
        transform: scale(1.04);
        opacity: 0.95;
    }

    .btn-secondary {
        background: #18bc9c;
        color: #fff;
        border-radius: .5rem;
        font-size: 1.1rem;
        font-weight: 700;
        padding: .75rem 2rem;
        margin: 10px 0;
        text-decoration: none;
        display: inline-block;
        border: none;
        transition: background .2s, transform .1s;
    }

    .btn-secondary:hover {
        background: #149174;
        transform: scale(1.04);
        opacity: 0.95;
    }

    .text-right {
        width: 100%;
        gap: 10px;
        margin-top: 2rem;
    }

    @media (max-width: 600px) {
        .comment-card {
            padding: 1rem .5rem;
        }

        .btn-primary,
        .btn-secondary {
            font-size: 1rem;
            padding: .5rem 1rem;
        }

        .text-right {
            align-items: stretch;
        }
    }
</style>

<div class="comment-card">
    <h2>إضافة تعليق جديد / Add New Comment</h2>
    <form action="{{ route('comments.store') }}" method="POST" style="margin-bottom:2rem;">
        @csrf
        <div class="form-group">
            <label for="employee_id">اختر الموظف / Select Employee</label>
            <select name="employee_id" id="employee_id" required>
                <option value=""> اختر موظف / Select Employee </option>
                @foreach($allEmployees as $emp)
                <option value="{{ $emp->id }}" {{ (isset($employee) && $employee->id == $emp->id) ? 'selected' : '' }}>
                    " {{ $emp->first_name }} {{ $emp->last_name }} " _ *ID = {{ $emp->id }}*
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="author">اسمك / Your Name</label>
            <input type="text" name="author" id="author" required>
        </div>
        <div class="form-group">
            <label for="body">التعليق / Comment</label>
            <textarea name="body" id="body" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">إرسال التعليق / Submit</button>
    </form>
    <hr>
    <span class="text-right">
        <a href="{{ route('employees.index') }}" class="btn-primary"> الرجوع لصفحة الموظفين / Back to employees</a>
        <a href="{{ route('views-welcome') }}" class="btn btn-secondary"> الذهاب الى الصفحة الرئيسية / Go home page </a>
    </span>
</div>