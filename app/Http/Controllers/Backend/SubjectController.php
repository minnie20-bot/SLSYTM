<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModels;
use Illuminate\Http\Request;
use App\Models\SubjectModels;
use App\Models\SubjectClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function subject_list()
    {
        $data['getRecord'] = SubjectModels::getRecord(Auth::User()->id, Auth::User()->is_admin);
        $data['meta_title'] = "Subject";

        return view('backend.subject.list', $data);
    }

    public function create_subject()
    {
        $data['meta_title'] = "Create Subject";
        return view('backend.subject.create', $data);
    }

    public function insert_subject(Request $request)
    {

        $save = new SubjectModels();
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

        return redirect('panel/subject')->with('success', "Subject Successfully created");
    }

    public function edit_subject($id)
    {
        $data['getRecord'] = SubjectModels::getSingle($id);
        $data['meta_title'] = " Edit Subject";
        return view('backend.subject.edit', $data);
    }

    public function update_subject($id, Request $request)
    {
      
        $save = SubjectModels::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->save();

        return redirect('panel/subject')->with('success', "Subject Successfully updated");
    }

    public function delete_subject($id)
    {
        $save = SubjectModels::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/subject')->with('success', "Subject Successfully deleted");
    }

    public function assign_subject_list(Request $request)
    {
        $data['getRecord'] = SubjectClassModel::getRecord(Auth::User()->id, Auth::User()->is_admin);
        $data['meta_title'] = "Assign Subject Class";

        return view('backend.assign_subject.list', $data);
    }

    public function create_assign_subject()
    {
        $data['getClass'] = ClassModels::getRecordActive(Auth::User()->id);
        $data['getSubject'] = SubjectModels::getRecordActive(Auth::User()->id);

        $data['meta_title'] = "Create Assign Subject Class";
        return view('backend.assign_subject.create', $data);
    }

    public function insert_assign_subject(Request $request)
    {
        if(!empty($request->class_id) && !empty($request->subject_id)) 
        {
            foreach($request->subject_id as $subject_id) 
            {
                if(!empty($subject_id))    
                {
                    $check = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);
                    if(empty($check))
                    {
                        $save = new SubjectClassModel();
                        $save->class_id = trim($request->class_id);
                        $save->subject_id = trim($subject_id);
                        $save->status = trim($request->status);
                        $save->created_by_id = Auth::user()->id;
                        $save->save();
                    }
                }
            }
        }

        return redirect('panel/assign-subject')->with('success', "Assign Subject Class Successfully Created.");

    }

    public function edit_assign_subject($id)
    {
        $getRecord = SubjectClassModel::getSingle($id);

        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModels::getRecordActive(Auth::User()->id);
        $data['getSubject'] = SubjectModels::getRecordActive(Auth::User()->id);
        $data['getSelectedSubject'] = SubjectClassModel::getSelectedSubject($getRecord->class_id, Auth::user()->id);

        $data['meta_title'] = "Edit Assign Subject Class";
        return view('backend.assign_subject.edit', $data);
    }

    public function update_assign_subject($id, Request $request)
    {
        if(!empty($request->class_id)) 
        {
            SubjectClassModel::deleteClassSubject($request->class_id, Auth::user()->id);

            foreach($request->subject_id as $subject_id) 
            {
                if(!empty($subject_id))    
                {
                    $check = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);
                    if(empty($check))
                    {
                        $save = new SubjectClassModel();
                        $save->class_id = trim($request->class_id);
                        $save->subject_id = trim($subject_id);
                        $save->status = trim($request->status);
                        $save->created_by_id = Auth::user()->id;
                        $save->save();
                    }
                }
            }
        }   
                return redirect('panel/assign-subject')->with('Success', "Assign Subject Class Successfully Updated.");
    }

    public function delete_assign_subject($id)
    {
        $save = SubjectClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign-subject')->with('Success', "Assign Subject Class Successfully Deleted");
    }




}