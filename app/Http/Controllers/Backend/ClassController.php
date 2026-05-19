<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModels;
use App\Models\ClassTeacherModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    public function class_list()
    {
        $data['getRecord'] = ClassModels::getRecord(Auth::User()->id, Auth::User()->is_admin);
        $data['meta_title'] = "Class";

        return view('backend.class.list', $data);
    }

    public function create_class()
    {
        $data['meta_title'] = "Create Class";
        return view('backend.class.create', $data);
    }

    public function insert_class(Request $request)
    {

        $save = new ClassModels();
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

        return redirect('panel/class')->with('success', "Class Successfully created");
    }

    public function edit_class($id)
    {
        $data['getRecord'] = ClassModels::getSingle($id);
        $data['meta_title'] = " Edit Class";
        return view('backend.class.edit', $data);
    }

    public function update_class($id, Request $request)
    {
      
        $save = ClassModels::getSingle($id);
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->save();

        return redirect('panel/class')->with('success', "Class Successfully updated");
    }

    public function delete_class($id)
    {
        $save = ClassModels::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/class')->with('success', "Class Successfully deleted");
    }

    public function assign_teacher_list(Request $request)
    {
        $data['getRecord'] = ClassTeacherModel::getRecord(Auth::User()->id, Auth::User()->is_admin);
        $data['meta_title'] = "Assign Teacher";

        return view('backend.assign_teacher.list', $data);
    }

    public function create_assign_teacher(Request $request)
    {
        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModels::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Create Assign Teacher";

        return view('backend.assign_teacher.create', $data);
    }

    public function insert_assign_teacher(Request $request)
    {
         if(!empty($request->class_id) && !empty($request->teacher_id)) 
        {
            foreach($request->teacher_id as $teacher_id) 
            {
                if(!empty($teacher_id))    
                {
                    $check = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                    if(empty($check))
                    {
                        $save = new ClassTeacherModel();
                        $save->class_id = trim($request->class_id);
                        $save->teacher_id = trim($teacher_id);
                        $save->status = trim($request->status);
                        $save->created_by_id = Auth::user()->id;
                        $save->save();
                    }
                }
            }
        }

        return redirect('panel/assign-teacher')->with('success', "Assign Teacher Successfully Created.");

    }

    public function edit_assign_teacher($id)
    {
        $getRecord = ClassTeacherModel::getSingle($id);
        $data['getRecord'] = $getRecord;

        $data['getSelectedTeacher'] = ClassTeacherModel::getSelectedTeacher( $getRecord->class_id, Auth::User()->id);

        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModels::getRecordActive(Auth::user()->id);

        $data['meta_title'] = "Edit Create Assign Teacher";
        return view('backend.assign_teacher.edit', $data);
    }

    public function update_assign_teacher($id, Request $request)
    {
        if(!empty($request->class_id)) 
        {
            ClassTeacherModel::deleteClassSubject($request->class_id, Auth::user()->id);

            foreach($request->teacher_id as $teacher_id) 
            {
                if(!empty($teacher_id))    
                {
                    $check = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                    if(empty($check))
                    {
                        $save = new ClassTeacherModel();
                        $save->class_id = trim($request->class_id);
                        $save->teacher_id = trim($teacher_id);
                        $save->status = trim($request->status);
                        $save->created_by_id = Auth::user()->id;
                        $save->save();
                    }
                }
            }
        }   
                return redirect('panel/assign-teacher')->with('Success', "Assign Teacher Successfully Updated.");
    }

    public function delete_assign_teacher($id)
    {
        $save = ClassTeacherModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign-teacher')->with('success', "Assign Teacher Successfully deleted");
    }


}



