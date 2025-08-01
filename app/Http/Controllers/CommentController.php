<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $forbidden = ['spamword1','spamword2','كلمة_ممنوعة'];

    public function store(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'author' => 'required|string|max:100',
            'body'   => ['required','string', function($attr, $value, $fail) {
                foreach ($this->forbidden as $word) {
                    if (stripos($value, $word) !== false) {
                        return $fail('تم رفض التعليق لاحتوائه على محتوى غير مناسب');
                    }
                }
            }],
        ]);

        $employee->comments()->create($data);
        return back()->with('success', 'تم إضافة التعليق بنجاح');
    }
}