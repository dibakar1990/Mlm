<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PaymentRequestNotification;
use App\Services\FileService;
use App\Models\PaymentRequest;
use App\Models\User;
use Auth, Notification;

class TransactionController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalAmount = PaymentRequest::where('user_id', Auth::user()->id)
                    ->where('status',1)
                    ->sum('request_amount');
        $datums = User::where('id', Auth::user()->id)
                ->with(['paymentRequest' => function($q) {
                    $q->where('status', 1);
                }])
                ->first();
        return view('frontend.payment.index',compact(
            'totalAmount',
            'datums'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'request_amount' => 'required|numeric',
            'transaction_id' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ];
        $customMessages = [
            'request_amount.required' => 'This field is required',
            'transaction_id.required' => 'This field is required',
            'file.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->hasFile('file')) {
            $uploaded_file = $request->file('file');
            $file_path = $this->fileService->store($uploaded_file, '/payment');
        }
        $user = User::find(Auth::user()->id);
        $paymentRequest = new PaymentRequest();
        $paymentRequest->request_amount = $request->request_amount;
        $paymentRequest->transaction_id = $request->transaction_id;
        $paymentRequest->remark = $request->remark;
        $paymentRequest->file_path = $file_path;
        $user->paymentRequest()->save($paymentRequest);
         //send notification
        $notificationDetails = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'unique_code' => $user->unique_code,
            'message' => 'New payment request created'
        ];
        $receiverUser = User::where('type',1)->first();
        Notification::send($receiverUser, new PaymentRequestNotification($notificationDetails));
        return redirect()->route('user.payment.pending.request.index')->with(['success' => "Payment request send successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PaymentRequest::findOrFail($id);
        return view('frontend.payment.view',compact(
            'data'
        ));
    }

    public function approved()
    {
        $totalAmount = PaymentRequest::where('user_id', Auth::user()->id)
                    ->where('status',2)
                    ->sum('request_amount');
        $datums = User::where('id', Auth::user()->id)
                ->with(['paymentRequest' => function($q) {
                    $q->where('status', 2);
                }])
                ->first();
        return view('frontend.payment.approved.index',compact(
            'totalAmount',
            'datums'
        ));
    }

    public function approved_show($id)
    {
        $data = PaymentRequest::findOrFail($id);
        return view('frontend.payment.approved.view',compact(
            'data'
        ));
    }

    public function canceled()
    {
        $totalAmount = PaymentRequest::where('user_id', Auth::user()->id)
                    ->where('status',0)
                    ->sum('request_amount');
        $datums = User::where('id', Auth::user()->id)
                ->with(['paymentRequest' => function($q) {
                    $q->where('status', 0);
                }])
                ->first();
        return view('frontend.payment.canceled.index',compact(
            'totalAmount',
            'datums'
        ));
    }

    public function canceled_show($id)
    {
        $data = PaymentRequest::findOrFail($id);
        return view('frontend.payment.canceled.view',compact(
            'data'
        ));
    }

}
