<?php

namespace App\Http\Controllers\User\Payment;

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
        $datums = Fund::with('user')->where('user_id',Auth::user()->id)->latest()->get();
        $totalAmount = Fund::where('user_id', Auth::user()->id)->sum('amount');
        return view('frontend.fund.index', compact(
            'datums',
            'totalAmount'
        ));
    }

    public function create()
    {
       
        return view('frontend.fund.create');
    }

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
        $currentUser = User::findOrFail(Auth::user()->id);
        if($currentUser->unique_code != $request->unique_code){
            $purpose = 'Transfer Fund for '.$user->name. ' by'.Auth::user()->name;
        }else{
            $purpose = 'Add Fund by '.Auth::user()->name;
        }
        
        // add fund transfer data insert
        $fund = new Fund();
        $fund->unique_code = $request->unique_code;
        $fund->amount = $request->amount;
        $fund->remark = $request->remark;
        $fund->added_by = $added_by;
        $fund->user_id = $user->id;
        $fund->status = 1;
        $fund->save();
        //transfer user wallet update
        $user->wallet_amount = $user->wallet_amount + $request->amount;
        $user->save();
        //transfer user passbook insert
        $creditPassbook = new Passbook();
        $creditPassbook->credit_amount = $request->amount;
        $creditPassbook->debit_amount = 0;
        $creditPassbook->current_balance = $user->wallet_amount;
        $creditPassbook->user_id = $user->id;
        $creditPassbook->purpose = $purpose;
        $creditPassbook->save();
        //current user passbook debit amount insert
        if($currentUser->unique_code != $request->unique_code)
        {
            $currentUser->wallet_amount = $currentUser->wallet_amount - $request->amount;
            $currentUser->save();

            $debitPassbook = new Passbook();
            $debitPassbook->credit_amount = 0;
            $debitPassbook->debit_amount = $request->amount;
            $debitPassbook->current_balance = $currentUser->wallet_amount;
            $debitPassbook->user_id = Auth::user()->id;
            $debitPassbook->purpose = 'Remove Fund for '.Auth::user()->name. ' by'.$user->name ;
            $debitPassbook->save();
        }
        return redirect()->route('user.funds.index')->with(['success' => "Item(s) added successfully"]);
    }

}
