<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentQR;

class PaymentQRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = PaymentQR::latest()->get();
        return view('frontend.payment-qr.index', compact(
            'datums'
        ));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PaymentQR::findOrFail($id);
        return view('frontend.payment-qr.view', compact(
            'data'
        ));
    }
}
