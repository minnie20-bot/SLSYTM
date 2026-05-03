<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubjectModels;
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
}
