<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SchoolController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SchoolAdminController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\SubjectController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\UserController;









Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth_login']);
Route::get('forgot', [AuthController::class, 'forgot']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::group(['middleware' => 'common'], function () {

    Route::get('panel/change-password', [UserController::class, 'change_password']);
    Route::post('panel/change-password', [UserController::class, 'update _password']);


    Route::get('panel/my-account', [UserController::class, 'my_account']);
    Route::post('panel/my-account', [UserController::class, 'update_account']);
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('panel/admin', [AdminController::class, 'admin_list']);
    Route::get('panel/admin/create', [AdminController::class, 'create_admin']);
    Route::post('panel/admin/create', [AdminController::class, 'insert_admin']);
    Route::get('panel/admin/edit/{id}', [AdminController::class, 'edit_admin']);
    Route::post('panel/admin/edit/{id}', [AdminController::class, 'update_admin']);
    Route::get('panel/admin/delete/{id}', [AdminController::class, 'delete_admin']);




    Route::get('panel/school', [SchoolController::class, 'school_list']);
    Route::get('panel/school/create', [SchoolController::class, 'create_school']);
    Route::post('panel/school/create', [SchoolController::class, 'insert_school']);
    Route::get('panel/school/edit/{id}', [SchoolController::class, 'edit_school']);
    Route::post('panel/school/edit/{id}', [SchoolController::class, 'update_school']);
    Route::get('panel/school/delete/{id}', [SchoolController::class, 'delete_school']);
});


Route::group(['middleware' => 'school'], function () {

    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('panel/teacher', [TeacherController::class, 'teacher_list']);
    Route::get('panel/teacher/create', [TeacherController::class, 'create_teacher']);
    Route::post('panel/teacher/create', [TeacherController::class, 'insert_teacher']);
    Route::get('panel/teacher/edit/{id}', [TeacherController::class, 'edit_teacher']);
    Route::post('panel/teacher/edit/{id}', [TeacherController::class, 'update_teacher']);
    Route::get('panel/teacher/delete/{id}', [TeacherController::class, 'delete_teacher']);

    Route::get('panel/student', [StudentController::class, 'student_list']);
    Route::get('panel/student/create', [StudentController::class, 'create_student']);
    Route::post('panel/student/create', [StudentController::class, 'insert_student']);
    Route::get('panel/student/edit/{id}', [StudentController::class, 'edit_student']);
    Route::post('panel/student/edit/{id}', [StudentController::class, 'update_student']);
    Route::get('panel/student/delete/{id}', [StudentController::class, 'delete_student']);
    Route::post('panel/student/getClass', [StudentController::class, 'getClass']);



    Route::get('panel/school_admin', [SchoolAdminController::class, 'school_admin_list']);
    Route::get('panel/school_admin/create', [SchoolAdminController::class, 'create_school_admin']);
    Route::post('panel/school_admin/create', [SchoolAdminController::class, 'insert_school_admin']);
    Route::get('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'edit_school_admin']);
    Route::post('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'update_school_admin']);
    Route::get('panel/school_admin/delete/{id}', [SchoolAdminController::class, 'delete_school_admin']);

    Route::get('panel/class', [ClassController::class, 'class_list']);
    Route::get('panel/class/create', [ClassController::class, 'create_class']);
    Route::post('panel/class/create', [ClassController::class, 'insert_class']);
    Route::get('panel/class/edit/{id}', [ClassController::class, 'edit_class']);
    Route::post('panel/class/edit/{id}', [ClassController::class, 'update_class']);
    Route::get('panel/class/delete/{id}', [ClassController::class, 'delete_class']);

    Route::get('panel/subject', [SubjectController::class, 'subject_list']);
    Route::get('panel/subject/create', [SubjectController::class, 'create_subject']);
    Route::post('panel/subject/create', [SubjectController::class, 'insert_subject']);
    Route::get('panel/subject/edit/{id}', [SubjectController::class, 'edit_subject']);
    Route::post('panel/subject/edit/{id}', [SubjectController::class, 'update_subject']);
    Route::get('panel/subject/delete/{id}', [SubjectController::class, 'delete_subject']);

    Route::get('panel/assign-subject', [SubjectController::class, 'assign_subject_list']);
    Route::get('panel/assign-subject/create', [SubjectController::class, 'create_assign_subject']);
    Route::post('panel/assign-subject/create', [SubjectController::class, 'insert_assign_subject']);
    Route::get('panel/assign-subject/edit/{id}', [SubjectController::class, 'edit_assign_subject']);
    Route::post('panel/assign-subject/edit/{id}', [SubjectController::class, 'update_assign_subject']);
    Route::get('panel/assign-subject/delete/{id}', [SubjectController::class, 'delete_assign_subject']);

    Route::get('panel/class-timetable', [SubjectController::class, 'class_timetable']);
    Route::post('panel/class-timetable', [SubjectController::class, 'submit_class_timetable']);
    Route::post('panel/get_assigned_subject_class', [SubjectController::class, 'get_assigned_subject_class']);


    Route::get('panel/assign-teacher', [ClassController::class, 'assign_teacher_list']);
    Route::get('panel/assign-teacher/create', [ClassController::class, 'create_assign_teacher']);
    Route::post('panel/assign-teacher/create', [ClassController::class, 'insert_assign_teacher']);
    Route::get('panel/assign-teacher/edit/{id}', [ClassController::class, 'edit_assign_teacher']);
    Route::post('panel/assign-teacher/edit/{id}', [ClassController::class, 'update_assign_teacher']);
    Route::get('panel/assign-teacher/delete/{id}', [ClassController::class, 'delete_assign_teacher']);
    Route::get('panel/get-subject-by-class/{class_id}', [ClassController::class, 'getSubjectByClass']);

});

Route::group(['middleware' => 'teacher'], function () {

    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/my-class-subjects', [ClassController::class, 'TeacherClassSubject']);
    Route::get('teacher/my-class-subjects/timetable/{class_id}/{subject_id}', [ClassController::class, 'TeacherTimeTable']);

});

Route::group(['middleware' => 'student'], function () {

    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

});
