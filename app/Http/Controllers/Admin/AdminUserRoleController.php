<?php

namespace App\Http\Controllers\Admin;

use App\users_role_name;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserRoleController extends Controller
{
    public function user_role()
    {
        $roles = users_role_name::all();
        return view('admin.role.userRole',compact('roles'));
    }

    public function user_role_save(Request $request)
    {
        $role = new users_role_name();
        $role->name = $request->name;
        $role->save();

        return back()->with('success','Role Created');
    }

    public function user_role_update(Request $request)
    {
        $update_role = users_role_name::where('id',$request->edit_role)->first();
        $update_role->name = $request->name;
        $update_role->save();
        return back()->with('success','Role Updated');
    }

    public function user_role_delete(Request $request)
    {
        $delete_role = users_role_name::where('id',$request->delete_role)->first();
        $delete_role->delete();
        return back()->with('success','Role Deleted');
    }

}
