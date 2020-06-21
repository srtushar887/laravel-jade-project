<?php

namespace App\Http\Controllers\Manager;

use App\assign_property;
use App\deposit;
use App\Manager;
use App\property;
use App\service_request;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ManagerController extends Controller
{
    public function index()
    {
        $available = property::where('is_lease',0)->count();
        $leased_property =  assign_property::count();
        $tanant = User::where('account_type',2)->count();
        $service = service_request::where('status',1)->orWhere('status',2)->count();
        $payments = assign_property::with('tanant')->where('is_paid',2)->with('property')->get();
        $total_amount = deposit::where('status',2)->sum('amt');
        return view('manager.index',compact('available','leased_property','tanant','service','payments','total_amount'));
    }

    public function profile()
    {
        $user = Manager::where('id',Auth::user()->id)->first();
        return view('manager.page.profile',compact('user'));
    }

    public function profile_save(Request $request)
    {
        $p_udate = Manager::where('id',Auth::user()->id)->first();
        $p_udate->first_name = $request->first_name;
        $p_udate->last_name = $request->last_name;
        $p_udate->user_name = $request->user_name;
        $p_udate->email = $request->email;
        $p_udate->phone_number = $request->phone_number;
        $p_udate->alt_phone_number = $request->alt_phone_number;
        $p_udate->save();

        return back()->with('success','Profile Updated');
    }

    public function password()
    {
        return view('manager.page.password');
    }

    public function password_save(Request $request)
    {
        $pass = $request->password;
        $c_pass = $request->c_password;
        if ($pass != $c_pass)
        {
            return back()->with('alert','Password Not Match');
        }else{
            $user_pass = Manager::where('id',Auth::user()->id)->first();
            $user_pass->password = Hash::make($request->password);
            $user_pass->save();
            return back()->with('success','Password Changed');

        }
    }

    public function transaction()
    {
        return view('manager.page.transaction');
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
