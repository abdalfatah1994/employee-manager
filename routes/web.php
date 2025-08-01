<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CommentController;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
})->name('home');

// صفحة الترحيب
Route::get('welcome-page', function () {
    return view('welcome');
})->name('views-welcome');

// صفحة جميع التعليقات (اختياري)
Route::get('comments', [CommentController::class, 'index'])->name('comments.index');

// موارد الموظفين (CRUD كامل)
Route::resource('employees', EmployeeController::class);

// عرض موظف محدد (موجود ضمن resource لكن يمكن تخصيصه)
Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

// إضافة تعليق عام (بدون ربط بموظف محدد)
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// إضافة تعليق لموظف محدد
Route::post(
    'employees/{employee}/comments',
    [CommentController::class, 'storeForEmployee']
)->name('employees.comments.store');

Route::post('employees-comments', [CommentController::class, 'store'])->name('employees-comments');
Route::get('employees-comments', function () {
    $allEmployees = \App\Models\Employee::all();
    return view('comments', compact('allEmployees'));
})->name('employees-comments');