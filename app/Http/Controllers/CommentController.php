<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // الكلمات الممنوعة للفلترة
    protected $blockedWords = ['bad', 'مرفوض', 'كسول', 'غير لائق'];

    public function store(Request $request)
    {
        // تحقق من صحة البيانات المدخلة
        $data = $request->validate([
            'author' => 'required|string|max:50',
            'body'   => 'required|string|max:500',
            'employee_id' => 'required|exists:employees,id',
        ]);

        // فلترة الكلمات الممنوعة في التعليق
        foreach ($this->blockedWords as $word) {
            if (stripos($data['body'], $word) !== false) {
                return back()->withInput()->withErrors(['body' => 'تم رفض التعليق لاحتوائه على محتوى غير مناسب']);
            }
        }

        // حفظ التعليق وربطه بالموظف المختار
        Comment::create([
            'author'      => $data['author'],
            'body'        => $data['body'],
            'employee_id' => $data['employee_id'],
        ]);

        // رسالة نجاح
        return back()->with('success', 'تم إضافة التعليق بنجاح');
    }
}