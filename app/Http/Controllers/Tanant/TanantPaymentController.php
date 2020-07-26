<?php

namespace App\Http\Controllers\Tanant;

use App\assign_property;
use App\deposit;
use App\general_setting;
use App\Http\Controllers\Controller;
use App\property;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TanantPaymentController extends Controller
{
    public function payment()
    {

        $user_property = property::where('tanant_id',Auth::user()->id)
            ->where('is_paid',1)
            ->sum('monthly_fee');
        $assign = assign_property::where('tanants_id',Auth::user()->id)->where('is_paid',1)->sum('amount');
        $user_trans = assign_property::where('tanants_id',Auth::user()->id)
            ->with('tanant')->with('property')->get();
        return view('user.payment.payment',compact('user_property','assign','user_trans'));

    }

    public function payment_create(Request $request)
    {

            $TranAmount = $request->amount;
            $TranTrackid=mt_rand();
            $TranportalId="187101";
            $ReqTranportalId="id=".$TranportalId;
            $ReqTranportalPassword="password=";
            $ReqAmount="amt=".$TranAmount;
            $ReqTrackId="trackid=".$TranTrackid;
            $ReqCurrency="currencycode=414";
            $ReqLangid="langid=USA";
            $ReqAction="action=1";

//            $ResponseUrl="http://localhost/client_project/jadeknet/index.php";
            $ResponseUrl="https://knet.jadeitegroup.com/index.php";
            $ReqResponseUrl="responseURL=".$ResponseUrl;

            Session::put('TRX',$TranTrackid);

//            $ErrorUrl="http://localhost/client_project/jadeknet/error.php";
            $ErrorUrl="https://knet.jadeitegroup.com/error.php";
            $ReqErrorUrl="errorURL=".$ErrorUrl;


            $ReqUdf1="udf1=Test1";
            $ReqUdf2="udf2=Test2";
            $ReqUdf3="udf3=Test3";
            $ReqUdf4="udf4=Test4";
            $ReqUdf5="udf5=Test5";



            $dep_save = new deposit();
            $dep_save->tanant_id = Auth::user()->id;
            $dep_save->paymentid = null;
            $dep_save->trackid = $TranTrackid;
            $dep_save->Error = null;
            $dep_save->result = null;
            $dep_save->postdate = Carbon::now();
            $dep_save->tranid = $TranTrackid;
            $dep_save->auth = null;
            $dep_save->avr = null;
            $dep_save->ref = null;
            $dep_save->amt = $TranAmount;
            $dep_save->udf1 = $ReqUdf1;
            $dep_save->udf2 = $ReqUdf2;
            $dep_save->udf3 = $ReqUdf3;
            $dep_save->udf5 = $ReqUdf5;
            $dep_save->status = 1;
            $dep_save->save();

            Session::put('Trans',$dep_save->trackid);

            $param=$ReqTranportalId."&".$ReqTranportalPassword."&".$ReqAction."&".$ReqLangid."&".$ReqCurrency."&".$ReqAmount."&".$ReqResponseUrl."&".$ReqErrorUrl."&".$ReqTrackId."&".$ReqUdf1."&".$ReqUdf2."&".$ReqUdf3."&".$ReqUdf4."&".$ReqUdf5;


            $termResourceKey="";
            $param=$this->encryptAES($param,$termResourceKey)."&tranportalId=".$TranportalId."&responseURL=".$ResponseUrl."&errorURL=".$ErrorUrl;

            $url = "https://kpaytest.com.kw/kpg/PaymentHTTP.htm?param=paymentInit"."&trandata=".$param;
            return redirect($url);

    }





    function encryptAES($str,$key) {

        $str = $this->pkcs5_pad($str);
        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $key);
        $encrypted = base64_decode($encrypted);
        $encrypted=unpack('C*', ($encrypted));
        $encrypted=$this->byteArray2Hex($encrypted);
        $encrypted = urlencode($encrypted);
        return $encrypted;
    }

    function pkcs5_pad ($text) {
        $blocksize = 16;
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
    function byteArray2Hex($byteArray) {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);
        return bin2hex($bin);
    }






}
