<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModels;
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
}
