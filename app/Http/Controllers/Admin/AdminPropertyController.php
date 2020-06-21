<?php

namespace App\Http\Controllers\Admin;

use App\assign_property;
use App\notification;
use App\property;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminPropertyController extends Controller
{
    public function property()
    {
        $property = property::all();
        return view('admin.property.property',compact('property'));
    }

    public function property_get()
    {
        $property = property::all();
        return DataTables::of($property)
            ->addColumn('action',function ($property){
                return '<a href="'.route('admin.property.edit',$property->id).'"> <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button></a>
                        <button class="btn btn-primary btn-xs" id="'.$property->id.'" onclick="deletemanu(this.id)" data-toggle="modal" data-target="#property-delete"><i class="fa fa-trash"></i></button>';
            })
            ->make(true);
    }

    public function property_create()
    {
        return view('admin.property.propertyCreate');
    }

    public function property_create_save(Request $request)
    {
        $property = new property();
        $property->property_name = $request->property_name;
        $property->property_address = $request->property_address;
        $property->property_description = $request->property_description;
        $property->property_style = $request->property_style;
        $property->pet_allow = $request->pet_allow;
        $property->property_year_build = $request->property_year_build;
        $property->property_size = $request->property_size;
        $property->property_bedroom = $request->property_bedroom;
        $property->property_bathroom = $request->property_bathroom;
        $property->property_parking_type = $request->property_parking_type;
        $property->property_air_con = $request->property_air_con;
        $property->monthly_fee = $request->monthly_fee;
        $property->let_fee = $request->let_fee;
        $property->deposit_fee = $request->deposit_fee;
        $property->property_google_map = $request->property_google_map;
        $property->status = $request->status;
        $property->is_lease = 0;
        $property->save();
        return back()->with('success','Property Created Successfully');
    }

    public function property_edit($id)
    {
        $edit_property = property::where('id',$id)->first();
        return view('admin.property.propertyEdit',compact('edit_property'));
    }

    public function property_update(Request $request)
    {
        $update_property = property::where('id',$request->id)->first();
        $update_property->property_name = $request->property_name;
        $update_property->property_address = $request->property_address;
        $update_property->property_description = $request->property_description;
        $update_property->property_style = $request->property_style;
        $update_property->pet_allow = $request->pet_allow;
        $update_property->property_year_build = $request->property_year_build;
        $update_property->property_size = $request->property_size;
        $update_property->property_bedroom = $request->property_bedroom;
        $update_property->property_bathroom = $request->property_bathroom;
        $update_property->property_parking_type = $request->property_parking_type;
        $update_property->property_air_con = $request->property_air_con;
        $update_property->property_google_map = $request->property_google_map;
        $update_property->monthly_fee = $request->monthly_fee;
        $update_property->let_fee = $request->let_fee;
        $update_property->deposit_fee = $request->deposit_fee;
        $update_property->is_lease = 0;
        $update_property->status = $request->status;
        $update_property->save();
        return back()->with('success','Property Updated Successfully');
    }

    public function property_delete(Request $request)
    {
        $delete_property = property::where('id',$request->delete_property)->first();
        $delete_property->delete();
        return back()->with('success','Property Deleted Successfully');
    }



    public function leased_property()
    {
        $leased_property = assign_property::with('tanant')->with('property')->get();
        return view('admin.property.leasedProperty',compact('leased_property'));
    }

    public function leased_property_get()
    {
        $leased_property = assign_property::with('tanant')->with('property')->get();
        return DataTables::of($leased_property)
            ->addColumn('action',function ($leased_property){
//                return '<a href="'.route('admin.leased.property.view',$leased_property->id).'"> <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button></a>
//                        <a href="'.route('admin.leased.property.view',$leased_property->id).'"> <button class="btn btn-primary btn-xs"><i class="fas fa-cut"></i></button></a>';
                return '<a href="'.route('admin.property.edit',$leased_property->id).'"> <button class="btn btn-primary btn-xs"><i class="fa "></i></button></a>
                        <button class="btn btn-primary btn-xs" id="'.$leased_property->id.'" onclick="deletemanu(this.id)" data-toggle="modal" data-target="#property-delete"><i class="fa fa-trash"></i></button>';

            })
            ->make(true);
    }

    public function leased_property_view($id)
    {
        $leased_property_view = assign_property::where('id',$id)->with('tanant')->with('property')->first();

        return view('admin.property.leasedPropertyView',compact('leased_property_view'));
    }

    public function leased_property_cancel(Request $request)
    {
        $lepro = assign_property::where('id',$request->plpro_id)->first();
        $pro = property::where('id',$lepro->property_id)->first();
        $pro->is_lease = 0;
        $pro->save();
        $lepro->delete();
        return back()->with('success','Lease property Canceled');


    }


    public function unleased_property()
    {
        $unleased_property = property::where('is_lease',0)->get();
        return view('admin.property.unleasedProperty',compact('unleased_property'));
    }

    public function unleased_property_get()
    {
        $unleased_property = property::where('is_lease',0)->get();
        return DataTables::of($unleased_property)
            ->addColumn('action',function ($unleased_property){
                return '<a href="'.route('admin.unleased.property.view',$unleased_property->id).'"> <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button></a>';
            })
            ->make(true);
    }

    public function unleased_property_view($id)
    {
        $unleaded_view = property::where('id',$id)->first();
        return view('admin.property.unleasedPropertyView',compact('unleaded_view'));
    }


    public function assign_property()
    {
        $property = property::where('is_lease',0)->get();
        $user = User::all();
        return view('admin.property.assignProperty',compact('property','user'));
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
            $property->monthly_fee = $request->amount;
            $property->save();

            $noti = new notification();
            $noti->user_id = $property->tanant_id;
            $noti->message = $request->message;
            $noti->save();

        }

        return back()->with('success','Assign Saved');

    }


}
