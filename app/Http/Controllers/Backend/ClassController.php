<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModels;
use App\Models\ClassTeacherModel;
use App\Models\SubjectClassModel;
use App\Models\User;
use App\Models\WeekModel;
use App\Models\ClassTimeTableModel;
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
        if (!empty($request->class_id) && !empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                if (!empty($teacher_id)) {
                    $check = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                    if (empty($check)) {
                        $save = new ClassTeacherModel();
                        $save->class_id = trim($request->class_id);
                        $save->teacher_id = trim($teacher_id);
                        $save->subject_class_id = trim($request->subject_id);
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

        $data['getSelectedTeacher'] = ClassTeacherModel::getSelectedTeacher($getRecord->class_id, Auth::User()->id);

        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModels::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectClassModel::getSelectedSubject($getRecord->class_id, Auth::User()->id);

        $data['meta_title'] = "Edit Create Assign Teacher";
        return view('backend.assign_teacher.edit', $data);
    }

    public function update_assign_teacher($id, Request $request)
    {
        if (!empty($request->class_id)) {

            ClassTeacherModel::where('class_id', $request->class_id)
                ->where('created_by_id', Auth::user()->id)
                ->delete();

            $teachers = (array) $request->teacher_id;

            foreach ($teachers as $teacher_id) {

                if (!empty($teacher_id)) {

                    ClassTeacherModel::create([
                        'class_id' => $request->class_id,
                        'teacher_id' => $teacher_id,
                        'subject_class_id' => $request->subject_id,
                        'status' => $request->status,
                        'created_by_id' => Auth::user()->id
                    ]);
                }
            }
        }

        return redirect('panel/assign-teacher')->with('success', "Updated Successfully.");
    }

    public function delete_assign_teacher($id)
    {
        $save = ClassTeacherModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign-teacher')->with('success', "Assign Teacher Successfully deleted");
    }

    public function TeacherClassSubject()
    {
        $data['getRecord'] = ClassTeacherModel::getRecordTeacher(Auth::User()->id);
        $data['meta_title'] = "My Class & Subjects";
        return view('teacher.class_subject.list', $data);
    }

    public function getSubjectByClass($class_id)
    {
        $subjects = SubjectClassModel::getSelectedSubject($class_id, Auth::User()->id);
        return response()->json($subjects);
    }

    public function TeacherTimeTable($class_id, $subject_id)
    {

        $result = array();
        $getWeek = WeekModel::getRecord();
        foreach($getWeek as $week)
        {
        
            $arraydata = array();
            $arraydata['id'] = $week->id;
            $arraydata['week_name'] = $week->name;
                $getClassTimeTable = ClassTimeTableModel::getRecord($class_id, $subject_id, $week->id);
                if(!empty($getClassTimeTable))
                {
                    $arraydata['start_time']    = $getClassTimeTable->start_time;
                    $arraydata['end_time']      = $getClassTimeTable->end_time;
                    $arraydata['room_number']   = $getClassTimeTable->room_number;
                }
                else
                {
                    $arraydata['start_time']    = '';
                    $arraydata['end_time']      = '';
                    $arraydata['room_number']   = '';
                }
            

            $result[] = $arraydata;
        }
                
        $data['getRecord'] = $result;

        $data['meta_title'] = "My Class & Subjects TimeTable";
        return view('teacher.class_subject.timetable', $data);

        }



}

