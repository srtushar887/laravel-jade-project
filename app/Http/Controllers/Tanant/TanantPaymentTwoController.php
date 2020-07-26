<?php

namespace App\Http\Controllers\Tanant;

use App\assign_property;
use App\deposit;
use App\general_setting;
use App\Http\Controllers\Controller;
use App\pdf_file;
use App\property;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use PDF;
class TanantPaymentTwoController extends Controller
{

    public function get_handle_response_data(Request $request)
    {

    }


    function decrypt($code,$key) {
        $code =  $this->hex2ByteArray(trim($code));
        $code=$this->byteArray2String($code);
        $iv = $key;
        $code = base64_encode($code);
        $decrypted = openssl_decrypt($code, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        return $this->pkcs5_unpad($decrypted);
    }

    function hex2ByteArray($hexString) {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }


    function byteArray2String($byteArray) {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }


    function pkcs5_unpad($text) {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }


    public function result(Request $request)
    {
        return redirect(route('user.make.payment'))->with('alert','Payment Not Success');
    }


    public function payment_success()
    {

        $payid = Session::get('paymentid');
        $trx = Session::get('TRX');
        $tradId  = Session::get('tranid');
        $auth  = Session::get('auth');
        $avr  = Session::get('avr');
        $ref  = Session::get('ref');

        $deposit_status = deposit::where('trackid',$trx)->first();
        $deposit_status->tranid = $tradId;
        $deposit_status->auth = $auth;
        $deposit_status->avr = $avr;
        $deposit_status->ref = $ref;
        $deposit_status->Error = "No Error";
        $deposit_status->result = "Success";
        $deposit_status->status = 2;
        $deposit_status->save();

        $assign = assign_property::where('tanants_id',$deposit_status->tanant_id)->where('is_paid',1)->first();
        $money = $assign->amount - $deposit_status->amt;

        $assnpro = assign_property::where('tanants_id',$deposit_status->tanant_id)->where('is_paid',1)->first();
        $assnpro->due = $money;
        $assnpro->is_paid = 2;
        $assnpro->save();

//         assign_property::where('tanants_id',$deposit_status->tanant_id)
//                   ->update(['is_paid' => 2]);

         property::where('tanant_id',$deposit_status->tanant_id)
             ->update(['is_paid' => 2]);



        $gen = general_setting::first();
        $user = User::where('id',$assign->tanants_id)->first();
        $form =$gen->site_email;
        $to = $user->email;
        $subject = "Payment";
        $message = "
Dear {$user->first_name}!

You Payment have been process successfully.
TRX ID : {$trx}.
Amount : {$assign->amount} KWD .
Date : {$assign->updated_at}.
Result : Payment Successfull.



Thanks,
{$gen->site_title}.
";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Do not reply <info@jadeitegorup.com>' . "\r\n";
        $headers .= "X-Sender: testsite < $form >\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers .= "X-Priority: 1\n"; // Urgent message!

        mail($to, $subject, $message,$headers);

        return redirect(route('user.make.payment'))->with('success','Payment Success');

    }



    public function payment_success_confirm($result,$trackid,$PaymentID,$tranid,$amount,$auth,$var,$ref,$postdate)
    {




        if ($result == "CAPTURED"){
            $deposit_status = deposit::where('trackid',$trackid)->first();
            $deposit_status->paymentid = $PaymentID;
            $deposit_status->result = $result;
            $deposit_status->tranid = $tranid;
            $deposit_status->auth = $auth;
            $deposit_status->avr = $var;
            $deposit_status->ref = $ref;
            $deposit_status->postdate = $postdate;
            $deposit_status->status = 2;
            $deposit_status->save();

            $assign = assign_property::where('tanants_id',$deposit_status->tanant_id)->where('is_paid',1)->first();
            $money = $assign->amount - $deposit_status->amt;

            $assnpro = assign_property::where('tanants_id',$deposit_status->tanant_id)->where('is_paid',1)->first();
            $assnpro->due = $money;
            $assnpro->is_paid = 2;
            $assnpro->depo_id = $deposit_status->id;
            $assnpro->save();

//         assign_property::where('tanants_id',$deposit_status->tanant_id)
//                   ->update(['is_paid' => 2]);

            property::where('tanant_id',$deposit_status->tanant_id)
                ->update(['is_paid' => 2]);



            $gen = general_setting::first();
            $user = User::where('id',$assign->tanants_id)->first();
            $form =$gen->site_email;
            $to = $user->email;
            $subject = "Payment";
            $message = "
Dear {$user->first_name}!

You Payment have been process successfully.
Track ID : {$trackid}.
Payment ID : {$PaymentID}.
Transaction ID : {$tranid}.
Amount : {$deposit_status->amt} KWD .
Date : {$assign->updated_at}.
Result : {$result}.



Thanks,
{$gen->site_title}.
";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Do not reply <info@jadeitegorup.com>' . "\r\n";
            $headers .= "X-Sender: testsite < $form >\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $headers .= "X-Priority: 1\n"; // Urgent message!

            mail($to, $subject, $message,$headers);

            return redirect(route('user.make.payment'))->with('success','Payment Success');
        }
        else{


            $deposit_status = deposit::where('trackid',$trackid)->first();
            $deposit_status->paymentid = $PaymentID;
            $deposit_status->result = $result;
            $deposit_status->tranid = $tranid;
            $deposit_status->auth = $auth;
            $deposit_status->avr = $var;
            $deposit_status->ref = $ref;
            $deposit_status->postdate = $postdate;
            $deposit_status->status = 1;
            $deposit_status->save();

            $assign = assign_property::where('tanants_id',$deposit_status->tanant_id)->where('is_paid',1)->first();
            $assign->depo_id = $deposit_status->id;


            $gen = general_setting::first();
            $user = User::where('id',$assign->tanants_id)->first();
            $form =$gen->site_email;
            $to = $user->email;
            $subject = "Payment";
            $message = "
Dear {$user->first_name}!

You Payment have been process Failed.
Track ID : {$trackid}.
Payment ID : {$PaymentID}.
Transaction ID : {$tranid}.
Amount : {$deposit_status->amt} KWD .
Date : {$assign->updated_at}.
Result : {$result}.



Thanks,
{$gen->site_title}.
";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Do not reply <info@jadeitegorup.com>' . "\r\n";
            $headers .= "X-Sender: testsite < $form >\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $headers .= "X-Priority: 1\n"; // Urgent message!

            mail($to, $subject, $message,$headers);

            return redirect(route('user.make.payment'))->with('alert','Payment Failed');
        }



    }


    public function payment_success_error($result,$trackid,$PaymentID,$tranid,$amount,$auth,$var,$ref,$postdate){




    }



    public function payment_error()
    {
        return redirect(route('user.make.payment'))->with('alert','Payment Not Success');

    }


    public function transaction_history()
    {
        return view('user.payment.transaction');
    }

    public function transaction_history_get()
    {
        $user_trans = assign_property::with('tanant')->with('property')->get();
        return DataTables::of($user_trans)
            ->addColumn('action',function ($user_trans){
                return ' <a href="'.route('user.pdf.trans',$user_trans->id).'"> <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button></a>';
            })
            ->make(true);
    }

    public function pdf($id)
    {
        $trans_his = assign_property::where('id',$id)->with('tanant')->with('property')->first();
        return view('pdf',compact('trans_his'));
    }

    public function downooad(Request $request)
    {
        $trans_his = assign_property::where('id',$request->aaa)->with('tanant')->with('property')->first();
        $pdf = PDF::loadView('pdf_download');
        return $pdf->download('payment.pdf');
    }


}
