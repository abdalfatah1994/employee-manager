<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        redirect()->route('employees.index')
            ->with('success', 'تم إضافة الموظف بنجاح / Employee added successfully');
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'rank'       => 'required|string',
            'email'      => 'required|email|unique:employees',
            'phone'      => 'required',
            'city'       => 'required|string',
            'salary'     => 'required|numeric|min:0',
            'department' => 'required|string',
            'description' => 'nullable|string|max:500',
        ]);

        Employee::create($data);
        return redirect()->route('employees.index')
            ->with('success', 'تم إضافة الموظف بنجاح');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // app/Http/Controllers/EmployeeController.php

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'rank'       => 'required|string',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'phone'      => 'required|string',
            'city'       => 'required|string',
            'salary'     => 'required|numeric|min:0',
            'department' => 'required|string',
            'description' => 'nullable|string|max:500',
        ]);

        $employee->update($data);

        // بعد التحديث: إعادة توجيه إلى صفحة التعديل +   رابط ومدة إعادة التوجيه
        return redirect()
            ->route('employees.index')
            ->with('success', 'تم تحديث بيانات الموظف بنجاح / Employee updated successfully')
            // ->with('redirectTo', route('employees.index'))
            ->with('redirectDelay', 3000); // بالمللي ثانية
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with('success', 'تم حذف الموظف بنجاح');
    }
    public function show(Employee $employee)
    {
        $comments = $employee->comments()->latest()->get(); // إذا كنت تستدعي التعليقات
        return view('employees.show', compact('employee', 'comments'));
    }
}
