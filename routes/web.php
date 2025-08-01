<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CommentController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('WELCOME-PAGE', function () {
    return view('welcome');
})->name('views-welcome');


/*
|--------------------------------------------------------------------------
| موارد الموظفين (CRUD كامل)
|--------------------------------------------------------------------------
| ينشئ تلقائيًا سبع طرق (index, create, store, show, edit, update, destroy)
| وتستخدم EmployeeController لإدارتها.
*/
Route::resource('employees', EmployeeController::class);
Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

/*
|--------------------------------------------------------------------------
| إضافة تعليق لموظف محدد
|--------------------------------------------------------------------------
| طريقة منفصلة للتعامل مع POST على "/employees/{employee}/comments"
| وتخزّن التعليق عبر CommentController@store مع اسم مسار واضح.
*/
Route::post(
    'employees/{employee}/comments',
    [CommentController::class, 'store']
)->name('employees.comments.store');