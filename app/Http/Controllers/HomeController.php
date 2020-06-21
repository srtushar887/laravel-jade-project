<?php

namespace App\Http\Controllers;

use App\assign_property;
use App\deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $deposits = deposit::where('tanant_id',Auth::user()->id)
            ->where('status',2)
            ->with('user')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        $total_amount = deposit::where('tanant_id',Auth::user()->id)->where('status',2)->sum('amt');
        $assign_pro = assign_property::where('tanants_id',Auth::user()->id)->count();
        return view('user.index',compact('deposits','total_amount','assign_pro'));
    }
}
