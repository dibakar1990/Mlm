<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\PaymentRequest;
use App\Models\Passbook;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalAmount = PaymentRequest::where('status',1)
                    ->sum('request_amount');
        $datums = PaymentRequest::with('user')->where('status', 1)->get();
        return view('backend.payment.index',compact(
            'totalAmount',
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
        $data = PaymentRequest::with('user')->where('id', $id)->first();
        return view('backend.payment.view',compact(
            'data'
        ));
    }

    public function payment_request(Request $request, $id)
    {
        $paymentRequest = PaymentRequest::find($id);
        $user = User::findOrFail($paymentRequest->user_id);
        //Request amount status update
        $paymentRequest->status = $request->status;
        $paymentRequest->save();

        if($request->status == 2){
            //update wallet amount to the request amount user
            $user->wallet_amount = $user->wallet_amount + $paymentRequest->request_amount;
            $user->save();
            // update passbook and 2 is approved
            $purpose = $user->name .' Your request amount has been approved by Admin';
            $passbook = new Passbook();
            $passbook->credit_amount = $paymentRequest->request_amount;
            $passbook->debit_amount = 0;
            $passbook->current_balance = $user->wallet_amount;
            $passbook->purpose = $purpose;
            $user->passbook()->save($passbook);
        }
        if($request->status == 2)
        {
            return redirect()->back()->with('success', 'Request payment has been approved Successfully!');
        }else{
            return redirect()->back()->with('success', 'Request payment has been canceled Successfully!');
        }
       
    }

    public function approved()
    {
        $totalAmount = PaymentRequest::where('status',2)
                    ->sum('request_amount');
        $datums = PaymentRequest::with('user')->where('status', 2)->get();
        return view('backend.payment.approved.index',compact(
            'totalAmount',
            'datums'
        ));
    }

    public function approved_show($id)
    {
        $data = PaymentRequest::with('user')->where('id', $id)->first();
        return view('backend.payment.approved.view',compact(
            'data'
        ));
    }

    public function canceled()
    {
        $totalAmount = PaymentRequest::where('status',0)
                    ->sum('request_amount');
        $datums = PaymentRequest::with('user')->where('status', 0)->get();
        return view('backend.payment.canceled.index',compact(
            'totalAmount',
            'datums'
        ));
    }

    public function canceled_show($id)
    {
        $data = PaymentRequest::with('user')->where('id', $id)->first();
        return view('backend.payment.canceled.view',compact(
            'data'
        ));
    }
}
