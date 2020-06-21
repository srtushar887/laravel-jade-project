<?php

namespace App\Http\Controllers;


use App\general_setting;
use App\User;
use Illuminate\Http\Request;

class VerityController extends Controller
{
    public function forgot_pass_send(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        $gn = general_setting::first();
        if ($user)
        {
            $chktm = $user->vsent+1000;
            $code = rand(000000000,999999999);
            $msg = 'Your Verification code is: '.$code;
            $subject = "Recover Password";
            $user->vercode = $code ;
            $user->vsent = $chktm ;
            $user->save();


            $to = $user->email;

            $headers = "From: $gn->site_email" . "\r\n" ;

            mail($to,"Recover Password",$msg);
            return back();
        }
    }
}
