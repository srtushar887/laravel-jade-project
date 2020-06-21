<?php

namespace App\Http\Controllers\Tanant;

use App\service_request;
use App\user_booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TanantBookkingController extends Controller
{
    public function booking_pool()
    {
        $booking = user_booking::orderBy('id','desc')->get();
        return view('user.booking.bookingPool',compact('booking'));
    }

    public function booking_pool_save(Request $request)
    {
        $booking = new user_booking();
        $booking->user_id = Auth::user()->id;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->status = 1;
        $booking->save();

        return back()->with('success','Booking Saved');
    }

    public function booking_pool_list()
    {
        return view('user.booking.bookingPoolList');
    }

    public function booking_pool_list_get()
    {
        $close_request = user_booking::where('user_id',Auth::user()->id)->get();
        return DataTables::of($close_request)
            ->addColumn('action',function ($close_request){

            })
            ->make(true);
    }
}
