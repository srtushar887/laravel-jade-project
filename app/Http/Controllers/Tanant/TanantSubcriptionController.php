<?php

namespace App\Http\Controllers\Tanant;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanantSubcriptionController extends Controller
{
    public function subs_pay()
    {
        $available_plan = [
            'webdevmatics_monthly' => "Monthly",
        ];

        $data = [
            'intent' => auth()->user()->createSetupIntent(),
            'plan' => $available_plan
        ];
        return view('user.subs.payment')->with($data);
    }

    public function subs_pay_save(Request $request)
    {

        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        $paymentMethod = $request->payment_method;
        $plan = $request->plan;
        $user->newSubscription('main', $plan)->create($paymentMethod);

        return response(['status' => 'success']);

    }
}
