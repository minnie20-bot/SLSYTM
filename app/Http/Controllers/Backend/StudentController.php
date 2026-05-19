<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class StudentController extends Controller
{
    public function student_list()
    {
        $data['getRecord'] = User::getStudent(Auth::User()->id, Auth::User()->is_admin);
        $data['meta_title'] = "student";
        return view('backend.student.list', $data);
    }

    public function getClass(Request $request)
    {
        $getClass = ClassModels::getRecordActive($request->school_id);

        $html = '';
        $html .= '<option value="">Select</option>';

        foreach ($getClass as $class) {
            $html .= '<option value="' . $class->id . '">' . $class->name . '</option>';
        }

        $json['success'] = $html;
        echo json_encode($json);
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
        request()->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $user                       = new User();
        $user->name                 = trim($request->name);
        $user->last_name            = trim($request->last_name);
        $user->gender               = trim($request->gender);
        $user->admission_number     = trim($request->admission_number);
        $user->roll_number          = trim($request->roll_number);
        $user->class_id             = trim($request->class_id);
        $user->date_of_birth        = trim($request->date_of_birth);
        $user->religion             = trim($request->religion);
        $user->mobile_number        = trim($request->mobile_number);
        $user->admission_date       = trim($request->admission_date);
        $user->blood_type           = trim($request->blood_type);
        $user->height               = trim($request->height);
        $user->weight               = trim($request->weight);
        $user->marital_status       = trim($request->marital_status);
        $user->address              = trim($request->address);
        $user->permanent_address    = trim($request->permanent_address);
        $user->email                = trim($request->email);
        $user->password             = Hash::make($request->password);
        $user->status               = trim($request->status);
        $user->is_admin             = 6;

        if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
            $user->created_by_id = $request->school_id;
        } else {
            $user->created_by_id = Auth::user()->id;
        }

        $user->save();

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);

            $user->profile_pic = $filename;
            $user->save();
        }


        return redirect('panel/student')->with('success', "Student Successfully created");
    }

    function edit_student($id)
    {
        $getRecord = User::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModels::getRecordActive($getRecord->created_by_id);
        $data['meta_title'] = "Edit student";
        return view('backend.student.edit', $data);
    }

    function update_student(Request $request, $id)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id, 'id'),
            ],
        ]);

        $user                       = User::getSingle($id);
        $user->name                 = trim($request->name);
        $user->last_name            = trim($request->last_name);
        $user->gender               = trim($request->gender);
        $user->admission_number     = trim($request->admission_number);
        $user->roll_number          = trim($request->roll_number);
        $user->class_id             = trim($request->class_id);
        $user->date_of_birth        = trim($request->date_of_birth);
        $user->religion             = trim($request->religion);
        $user->mobile_number        = trim($request->mobile_number);
        $user->admission_date       = trim($request->admission_date);
        $user->blood_type           = trim($request->blood_type);
        $user->height               = trim($request->height);
        $user->weight               = trim($request->weight);
        $user->marital_status       = trim($request->marital_status);
        $user->address              = trim($request->address);
        $user->permanent_address    = trim($request->permanent_address);
        $user->email                = trim($request->email);
        if (!empty($request->password)) {
            $user->password             = Hash::make($request->password);
        }
        $user->status               = trim($request->status);

        $user->save();

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);

            $user->profile_pic = $filename;
            $user->save();
        }


        return redirect('panel/student')->with('success', "Student Successfully updated");
    }

    function delete_student($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/student')->with('success', "Student Successfully deleted");
    }
}
