<?php

namespace App\Http\Controllers\Manager;

use App\user_booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ManagerBookingController extends Controller
{
    public function booking()
    {
        return view('manager.booking.bookingList');
    }

    public function booking_get()
    {
        $user_booking = user_booking::with('user')->get();
        return DataTables::of($user_booking)
            ->addColumn('action',function ($user_booking){
                return ' <button class="btn btn-primary btn-xs" id="'.$user_booking->id.'" onclick="mangerbooking(this.id)" data-toggle="modal" data-target="#manager-booking"><i class="fa fa-eye"></i></button>';
            })
            ->make(true);
    }

    public function booking_save(Request $request)
    {
        $action = $request->action;
        if ($action == 1){

            $booking = user_booking::where('id',$request->booking_id)->first();
            $booking->status = 2;
            $booking->save();
            return back()->with('success','Booking Confrimed');
        }else{
            $booking = user_booking::where('id',$request->booking_id)->first();
            $booking->status = 3;
            $booking->save();
            return back()->with('success','Booking Rejected');
        }
    }
}
