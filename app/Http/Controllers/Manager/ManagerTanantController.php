<?php

namespace App\Http\Controllers\Manager;

use App\User;
use App\user_lease_propety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ManagerTanantController extends Controller
{
    public function tanant_list()
    {
        return view('manager.tanant.tanantList');
    }

    public function tanant_list_get()
    {
        $tanant = User::all();
        return DataTables::of($tanant)
            ->addColumn('action',function ($tanant){
                return ' <button class="btn btn-primary btn-xs" id="'.$tanant->id.'" onclick="managertanantdetails(this.id)" data-toggle="modal" data-target="#manager-tatantlist"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function tanant_list_single(Request $request)
    {
        $singe_tanant = User::where('id',$request->id)->first();
        return response($singe_tanant);
    }
}
