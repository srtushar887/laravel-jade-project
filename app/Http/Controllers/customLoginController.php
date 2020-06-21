<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class customLoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            return redirect(route('home'));
        }
        elseif(Auth::guard('manager')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            return redirect(route('manager.dashboard'));
        }
        else{
            return back();
        }
    }


    public function register(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->account_type = 1;
        $user->save();


        $to = $user->email;
        $url = route('login');
        $subject ="Account Information";
        $message = "
Hey !

This email is confirmation that you are now registered at our Website.

Registered email: {$to}
Password: 12345678

You can login any time: {$url}


Thanks,
Jade Group.
";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to,$subject,$message);

        return redirect(route('login'))->with('success','Account Created . Admin will review and approve account');

    }
}
