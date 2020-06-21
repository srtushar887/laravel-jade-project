<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVerifyController extends Controller
{
    public function user_verity()
    {
        Auth::guard('web')->logout();
        return redirect(route('login'))->with('alert','Sorry! Account Not Active');
    }
}
