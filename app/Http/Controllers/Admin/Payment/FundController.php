<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Fund;
use App\Models\Passbook;
use App\Models\User;
use Auth;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = Fund::with('user')->latest()->get();
      
        return view('backend.fund.index', compact(
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
        return view('backend.fund.create');
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
            'unique_code' => 'required',
            'amount' => 'required|numeric',
            'remark' => 'required'
        ];
        $customMessages = [
            'unique_code.required' => 'This field is required',
            'amount.required' => 'This field is required',
            'remark.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $user = User::where('unique_code',$request->unique_code)->first();
        if(empty($user)){
            return redirect()->back()->with(['error' => "Unique code does not exist"]);
        }

        $userType = Auth::user()->type;
        if($userType == 1){
            $added_by = 'Admin';
        }else if($userType == 2){
            $added_by = 'User';
        }else{
            $added_by = null;
        }
        
        // add fund insert data
        $fund = new Fund();
        $fund->unique_code = $request->unique_code;
        $fund->amount = $request->amount;
        $fund->remark = $request->remark;
        $fund->added_by = $added_by;
        $fund->user_id = $user->id;
        $fund->status = 1;
        $fund->save();
        // user wallet amount update
        $user->wallet_amount = $user->wallet_amount + $request->amount;
        $user->save();
        //passbook insert data
        $passbook = new Passbook();
        $passbook->credit_amount = $request->amount;
        $passbook->debit_amount = 0;
        $passbook->current_balance = $user->wallet_amount;
        $passbook->user_id = $user->id;
        $passbook->purpose = 'Fund Transfer for '.$user->name. ' by Admin' ;
        $passbook->save();

        return redirect()->route('admin.funds.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
