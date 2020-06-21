<?php

namespace App\Http\Controllers\Tanant;

use App\assign_property;
use App\service_request;
use App\user_lease_propety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TanantServiceRequestController extends Controller
{
    public function create_service_request()
    {
        $user_property = assign_property::where('tanants_id',Auth::user()->id)->with('property')->get();
        return view('user.request.serviceRequest',compact('user_property'));
    }

    public function save_service_request(Request $request)
    {
        $save_req = new service_request();
        $save_req->property_id = $request->sel_propety;
        $save_req->user_id = Auth::user()->id;
        $save_req->request_title = $request->request_title;
        $save_req->priority = $request->sel_priority;
        $save_req->request_des = $request->request_des;
        $save_req->status = 0;
        $save_req->save();
        return back()->with('success','Service Request Created');

    }

    public function save_service_request_open()
    {
        $active_request = service_request::where('user_id',Auth::user()->id)->where('status',0)
            ->orWhere('status',1)
            ->with('tantan')
            ->with('property')
            ->get();
        return view('user.request.serviceRequestOpen',compact('active_request'));
    }

    public function save_service_request_open_get()
    {
        $active_request = service_request::where('user_id',Auth::user()->id)->where('status',0)
            ->orWhere('status',1)
            ->with('tantan')
            ->with('property')
            ->get();
        return DataTables::of($active_request)
            ->addColumn('action',function ($active_request){

            })
            ->make(true);
    }

    public function save_service_request_close()
    {
        $close_request = service_request::where('user_id',Auth::user()->id)->where('status',3)
            ->with('tantan')
            ->with('property')
            ->get();
        return view('user.request.serviceRequestClose',compact('close_request'));
    }

    public function save_service_request_close_get()
    {
        $close_request = service_request::where('user_id',Auth::user()->id)->where('status',3)
            ->with('tantan')
            ->with('property')
            ->get();
        return DataTables::of($close_request)
            ->addColumn('action',function ($close_request){

            })
            ->make(true);
    }
}
