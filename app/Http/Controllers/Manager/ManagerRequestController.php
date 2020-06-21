<?php

namespace App\Http\Controllers\Manager;

use App\service_request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ManagerRequestController extends Controller
{
    public function open_service_request()
    {
        return view('manager.request.openRequest');
    }

    public function open_service_request_get()
    {
        $active_request = service_request::where('status','!=',2)->with('tantan')
            ->with('property')
            ->get();
        return DataTables::of($active_request)
            ->addColumn('action',function ($active_request){
                return ' <button class="btn btn-primary btn-xs" id="'.$active_request->id.'" onclick="manageropenrequest(this.id)" data-toggle="modal" data-target="#manager-open-request"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function open_service_request_save(Request $request)
    {
        $action = $request->action;
        if ($action == 1)
        {
            $request = service_request::where('id',$request->request_id)->first();
            $request->status = 1;
            $request->save();
            return back()->with('success','Request In Process');
        }else{
            $request = service_request::where('id',$request->request_id)->first();
            $request->status = 2;
            $request->save();
            return back()->with('success','Request Close');
        }
    }

    public function open_service_request_close()
    {
        return view('manager.request.closeRequest');
    }

    public function open_service_request_close_get()
    {
        $active_request = service_request::where('status',2)->with('tantan')
            ->with('property')
            ->get();
        return DataTables::of($active_request)
            ->addColumn('action',function ($active_request){
                return ' <button class="btn btn-primary btn-xs" id="'.$active_request->id.'" onclick="managercloserequest(this.id)" data-toggle="modal" data-target="#manager-close-request"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }
}
