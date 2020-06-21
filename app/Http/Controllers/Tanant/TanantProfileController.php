<?php

namespace App\Http\Controllers\Tanant;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TanantProfileController extends Controller
{
    public function profile()
    {
        $user = User::where('id',Auth::user()->id)->first();
        return view('user.page.profile',compact('user'));
    }

    public function profile_save(Request $request)
    {
        $p_udate = User::where('id',Auth::user()->id)->first();
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
        return view('user.page.password');
    }

    public function change_password_save(Request $request)
    {
        $pass = $request->password;
        $c_pass = $request->c_password;
        if ($pass != $c_pass)
        {
            return back()->with('alert','Password Not Match');
        }else{
            $user_pass = User::where('id',Auth::user()->id)->first();
            $user_pass->password = Hash::make($request->password);
            $user_pass->save();
            return back()->with('success','Password Changed');

        }
    }
}
