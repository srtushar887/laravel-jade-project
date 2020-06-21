<?php

namespace App\Http\Controllers\Tanant;

use App\assign_property;
use App\User;
use App\user_lease_propety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TanantPropertyController extends Controller
{
    public function my_property()
    {
        return view('user.property.myProperty');
    }

    public function my_property_get()
    {
        $user_property = assign_property::with('tanant')
            ->with('property')->get();
        return DataTables::of($user_property)
            ->addColumn('action',function ($user_property){
                return '<a href="'.route('user.property.view',$user_property->id).'"> <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button></a>';
            })
            ->make(true);
    }

    public function my_property_view()
    {
        $assign_property = assign_property::where('tanants_id',Auth::user()->id)->with('property')->first();
        if ($assign_property){
            return view('user.property.myPropertyView',compact('assign_property'));
        }else{
            return back()->with('alert',"You dont have any property");
        }
    }


}
