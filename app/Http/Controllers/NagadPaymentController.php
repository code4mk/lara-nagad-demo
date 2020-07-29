<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NagadPayment;

class NagadPaymentController extends Controller
{
    public function pay() {
        $id = '12';
        $amount = "100";
        $redirectUrl = NagadPayment::tnxID($id)
                 ->amount($amount)
                 ->getRedirectUrl();
       //return response()->json($redirectUrl);
       return redirect($redirectUrl);
    }
    public function callback()
    {
        $verify = (object) NagadPayment::verify();
        if($verify->status === 'Success'){
            $order = json_decode($verify->additionalMerchantInfo);
            $oid = $order->tnx_id;
        }
        if ($verify->status === 'Aborted') {
            dd($verify);
        }
        dd($verify);
    }
}
