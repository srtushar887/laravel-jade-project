<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\notification;
use App\User;
use App\user_booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminBookingController extends Controller
{
    public function booking()
    {
        $user_booking = user_booking::with('user')->get();
        return view('admin.booking.bookingList',compact('user_booking'));
    }

    public function booking_get()
    {
        $user_booking = user_booking::with('user')->get();
        return DataTables::of($user_booking)
            ->addColumn('action',function ($user_booking){
                return ' <button class="btn btn-primary btn-xs" id="'.$user_booking->id.'" onclick="adminbooking(this.id)" data-toggle="modal" data-target="#admin-booking"><i class="fa fa-eye"></i></button>';
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

            $noti = new notification();
            $noti->user_id = $booking->user_id;
            $noti->message = $request->message;
            $noti->save();

            $user = User::where('id',$booking->user_id)->first();
            $email = $user->email;
            $to      = $email;
            $subject = 'the subject';
            $message = 'hello';
            mail($to, $subject, $message);

            return back()->with('success','Booking Confrimed');
        }else{
            $booking = user_booking::where('id',$request->booking_id)->first();
            $booking->status = 3;
            $booking->save();

            $noti = new notification();
            $noti->user_id = $booking->user_id;
            $noti->message = $request->message;
            $noti->save();

            $user = User::where('id',$booking->user_id)->first();
            $email = $user->email;

            return back()->with('success','Booking Rejected');
        }
    }
}
