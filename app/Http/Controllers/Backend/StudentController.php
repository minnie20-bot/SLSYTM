<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\classModel;
use App\Models\ClassModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class StudentController extends Controller
{
    public function student_list()
    {
        $data['getRecord'] = User::getTeacher(Auth::User()->id, Auth::User()->is_admin);
        $data['meta_title'] = "student";
        return view('backend.student.list', $data);
    }

    public function create_student()
    {
        $data['getClass'] = ClassModels::getRecordActive(Auth::user()->id);
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Create student";
        return view('backend.student.create', $data);
    }

    public function insert_student(Request $request)
    {
        dd($request->all());
    }
}
