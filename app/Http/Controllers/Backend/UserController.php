<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function my_account()
    {
        $data['meta_title'] = 'My Account';
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        return view('backend.my_account', $data);
    }

    public function update_account(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        $user->name = trim($request->name);
        if(Auth::user()->is_admin != 3)
        {
            $user->last_name = trim($request->last_name);
        }
        
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);

            $user->profile_pic = $filename;
        }

            $user->save();
            
            return redirect()->back()->with('success', 'Account updated successfully.');
    }

    public function change_password()
    {
        $data['meta_title'] = 'Change Password';
        return view('backend.change_password', $data);
    }

    public function update_password(Request $request)
    {
        if($request->new_password == $request->confirm_password)
            {
                $user = User::getSingle(Auth::user()->id);

                if (Hash::check($request->old_password, $user->password))
                {
                    $user->password = Hash::make($request->new_password);
                    $user->save();

                    return redirect()->back()->with('success', 'Password updated successfully.');
                } else {
                    return redirect()->back()->with('error', 'Old password is incorrect.');
                }
            }
        else
            {
                return redirect()->back()->with('error', 'New password and confirm password do not match.');
            }
    }
}
