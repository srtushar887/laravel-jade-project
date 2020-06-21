<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\assign_property;
use App\deposit;
use App\general_setting;
use App\property;
use App\service_request;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $available = property::where('is_lease',0)->count();
        $leased_property =  assign_property::count();
        $tanant = User::where('account_type',2)->count();
        $service = service_request::where('status',1)->orWhere('status',2)->count();
        $payments = assign_property::with('tanant')->where('is_paid',2)->with('property')->get();
        $total_amount = deposit::where('status',2)->sum('amt');
        $as_pro_paid = assign_property::with('tanant')->with('property')->get();
        return view('admin.index',compact('available','leased_property','tanant','service','payments','total_amount','as_pro_paid'));
    }

    public function general_setting()
    {
        $gn = general_setting::first();
        return view('admin.page.generalSetting',compact('gn'));
    }

    public function general_setting_save(Request $request)
    {
        $gen = general_setting::first();
        if($request->hasFile('site_icon')){
            @unlink($gen->site_icon);
            $image = $request->file('site_icon');
            $imageName = uniqid().'.'.$image->getClientOriginalName('site_icon');
            $directory = 'assets/admin/images/logo/';
            $imgUrl  = $directory.$imageName;
            Image::make($image)->save($imgUrl);
            $gen->site_icon = $imgUrl;
        }
        if($request->hasFile('site_logo')){
            @unlink($gen->site_logo);
            $image = $request->file('site_logo');
            $imageName = uniqid().'.'.$image->getClientOriginalName('site_logo');
            $directory = 'assets/admin/images/logo/';
            $imgUrl  = $directory.$imageName;
            Image::make($image)->save($imgUrl);
            $gen->site_logo = $imgUrl;
        }

        $gen->site_title = $request->site_title;
        $gen->site_sub_title = $request->site_sub_title;
        $gen->site_email = $request->site_email;
        $gen->site_number = $request->site_number;
        $gen->save();
        return back()->with('success','General Settings Saved Successfully');
    }


    public function profile()
    {
        $user = Admin::where('id',Auth::user()->id)->first();
        return view('admin.page.profile',compact('user'));
    }

    public function profile_save(Request $request)
    {
        $p_udate = Admin::where('id',Auth::user()->id)->first();
        $p_udate->first_name = $request->first_name;
        $p_udate->last_name = $request->last_name;
        $p_udate->user_name = $request->user_name;
        $p_udate->email = $request->email;
        $p_udate->phone_number = $request->phone_number;
        $p_udate->alt_phone_number = $request->alt_phone_number;
        $p_udate->save();

        return back()->with('success','Profile Updated');
    }

    public function change_password()
    {
        return view('admin.page.password');
    }

    public function password_save(Request $request)
    {
        $pass = $request->password;
        $c_pass = $request->c_password;
        if ($pass != $c_pass)
        {
            return back()->with('alert','Password Not Match');
        }else{
            $user_pass = Admin::where('id',Auth::user()->id)->first();
            $user_pass->password = Hash::make($request->password);
            $user_pass->save();
            return back()->with('success','Password Changed');

        }
    }


    public function transaction()
    {
        $trans = assign_property::with('tanant')->with('property')->get();
        return view('admin.page.transaction',compact('trans'));
    }

    public function transaction_get()
    {
        $trans = assign_property::with('tanant')->with('property')->get();
        return DataTables::of($trans)
            ->addColumn('action',function ($trans){
            })
            ->make(true);
    }

}
