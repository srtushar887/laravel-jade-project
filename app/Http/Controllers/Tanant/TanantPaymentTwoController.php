<?php

namespace App\Http\Controllers\Tanant;

use App\assign_property;
use App\deposit;
use App\Http\Controllers\Controller;
use App\pdf_file;
use App\property;
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
        $trx = Session::get('TRX');
        $deposit_status = deposit::where('trackid',$trx)->first();
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

        return redirect(route('user.make.payment'))->with('success','Payment Success');

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
