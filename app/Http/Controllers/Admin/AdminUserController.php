<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Manager;
use App\notification;
use App\property;
use App\User;
use App\users_role_name;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function user_create()
    {
        $roles = users_role_name::all();
        return view('admin.users.createUser',compact('roles'));
    }

    public function user_create_save(Request $request)
    {
        $role = $request->role;
        if ($role == 1)
        {
            $admin = new Admin();
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->user_name = $request->user_name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->account_type = $request->account_type;
            $admin->save();
            return back()->with('success','Admin Account Created');
        }elseif ($role == 3){
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->account_type = $request->account_type;
            $user->save();

            $noti = new notification();
            $noti->user_id = $user->id;
            $noti->message = $request->message;
            $noti->save();

            return back()->with('success','Tanant Account Created');
        }else{
            $manager = new Manager();
            $manager->first_name = $request->first_name;
            $manager->last_name = $request->last_name;
            $manager->user_name = $request->user_name;
            $manager->email = $request->email;
            $manager->password = Hash::make($request->password);
            $manager->account_type = $request->account_type;
            $manager->save();
            return back()->with('success','Manager Account Created');
        }
    }

    public function admin_list()
    {
        $admin = Admin::all();
        return view('admin.users.adminList',compact('admin'));
    }

    public function admin_list_get()
    {
        $admin = Admin::all();
        return DataTables::of($admin)
            ->addColumn('action',function ($admin){
                return ' <button class="btn btn-primary btn-xs" id="'.$admin->id.'" onclick="adminadmindetails(this.id)" data-toggle="modal" data-target="#admin-adminlist"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function admin_single_admin(Request $request)
    {
        $single_admin = Admin::where('id',$request->id)->first();
        return response($single_admin);
    }

    public function admin_admin_details_update(Request $request)
    {
        $admin_details = Admin::where('id',$request->admin_edit_id)->first();
        $admin_details->first_name = $request->first_name;
        $admin_details->last_name = $request->last_name;
        $admin_details->user_name = $request->user_name;
        $admin_details->phone_number = $request->phone_number;
        $admin_details->email = $request->email;
        $admin_details->account_type = $request->account_type;
        $admin_details->save();

        return back()->with('success','Admin Details Updated');
    }

    public function admin_manager_list()
    {
        $manager = Manager::all();
        return view('admin.users.managerList',compact('manager'));
    }

    public function admin_manager_get()
    {
        $manager = Manager::all();
        return DataTables::of($manager)
            ->addColumn('action',function ($manager){
                return ' <button class="btn btn-primary btn-xs" id="'.$manager->id.'" onclick="adminmanagerdetails(this.id)" data-toggle="modal" data-target="#admin-managerlist"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function admin_manager_single(Request $request)
    {
        $single_manager = Manager::where('id',$request->id)->first();
        return response($single_manager);
    }

    public function admin_manager_update(Request $request)
    {
        $manager_details = Manager::where('id',$request->admin_edit_id)->first();
        $manager_details->first_name = $request->first_name;
        $manager_details->last_name = $request->last_name;
        $manager_details->user_name = $request->user_name;
        $manager_details->phone_number = $request->phone_number;
        $manager_details->email = $request->email;
        $manager_details->account_type = $request->account_type;
        $manager_details->save();

        return back()->with('success','Manager Details Updated');
    }

    public function admin_tanant_list()
    {
        $tanant = User::all();
        return view('admin.users.tanantList',compact('tanant'));
    }

    public function admin_tanant_get()
    {
        $tanant = User::all();
        return DataTables::of($tanant)
            ->addColumn('action',function ($tanant){
                return ' <button class="btn btn-primary btn-xs" id="'.$tanant->id.'" onclick="admintanantdetails(this.id)" data-toggle="modal" data-target="#admin-tanantlist"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function admin_tanant_single(Request $request)
    {
        $single_tanant = User::where('id',$request->id)->first();
        return response($single_tanant);
    }

    public function admin_tanant_update(Request $request)
    {
        $tanant_details = User::where('id',$request->user_edit_id)->first();
        $tanant_details->first_name = $request->first_name;
        $tanant_details->last_name = $request->last_name;
        $tanant_details->user_name = $request->user_name;
        $tanant_details->phone_number = $request->phone_number;
        $tanant_details->email = $request->email;
        $tanant_details->account_type = $request->account_type;
        $tanant_details->password = Hash::make($request->password);
        $tanant_details->show_pass = $request->password;
        $tanant_details->save();

        return back()->with('success','Tanant Details Updated');
    }


}
