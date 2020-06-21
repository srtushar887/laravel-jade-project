<?php

namespace App\Http\Controllers\Manager;

use App\assign_property;
use App\property;
use App\User;
use App\user_lease_propety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ManagerPropertyController extends Controller
{
    public function property_list()
    {
        return view('manager.property.propertyList');
    }

    public function property_list_get()
    {
        $property = property::all();
        return DataTables::of($property)
            ->addColumn('action',function ($property){
                return '<button class="btn btn-primary btn-xs" id="'.$property->id.'" onclick="deletemanu(this.id)" data-toggle="modal" data-target="#property-delete"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function assign_property()
    {
        $property = property::where('is_lease',0)->get();
        $user = User::all();
        return view('manager.property.assignProperty',compact('property','user'));
    }

    public function assign_property_save(Request $request)
    {
        $save_assign = new assign_property();
        $save_assign->property_id = $request->property_id;
        $save_assign->tanants_id = $request->tanants_id;
        $save_assign->assign_name = Auth::user()->first_name.' '.Auth::user()->last_name;
        $save_assign->trems = $request->trems;
        $save_assign->amount = $request->amount;
        $save_assign->start_date = $request->start_date;
        $save_assign->last_date = $request->last_date;
        $save_assign->status = 1;
        $save_assign->is_paid = 1;

        if ($save_assign->save()){
            $property = property::where('id',$request->property_id)->first();
            $property->is_lease = 1;
            $property->tanant_id = $request->tanants_id;
            $property->is_paid = 1;
            $property->save();
        }

        return back()->with('success','Assign Saved');

    }

    public function leased_property()
    {
        return view('manager.property.leasedProperty');
    }

    public function leased_property_get()
    {
        $leased_property = assign_property::with('tanant')->with('property')->get();
        return DataTables::of($leased_property)
            ->addColumn('action',function ($leased_property){
            })
            ->make(true);
    }

    public function unleased_property()
    {
        return view('manager.property.unleasedProperty');
    }

    public function unleased_property_get()
    {
        $unleased_property = property::where('is_lease',0)->get();
        return DataTables::of($unleased_property)
            ->addColumn('action',function ($unleased_property){
                return ' <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }
}
