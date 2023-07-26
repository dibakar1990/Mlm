<?php

namespace App\Http\Controllers\User\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PlanSubscriptionNotification;
use App\Models\Automation;
use App\Models\Level;
use App\Models\LevelBonus;
use App\Models\Subscription;
use App\Models\GlobalPlan;
use App\Models\Generation;
use App\Models\User;
use App\Models\Passbook;
use App\Models\Setting;
use Auth, Notification;

class SubscriptionController extends Controller
{
    public function index()
    {
        $items = Subscription::with('user','plan')->latest()->get();
        return view('frontend.subscription.index',compact('items'));
    }
    
    public function create()
    {
        $plans = GlobalPlan::where('status',1)->get();
        return view('frontend.subscription.create',compact('plans'));
    }

    public function store(Request $request)
    {
        $rules = [
            'plan_id' => 'required'
        ];
        $customMessages = [
            'plan_id.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        // get current user
        $user = User::where('id',Auth::user()->id)->first();
        // get request plan data
        $plan = GlobalPlan::where('id',$request->plan_id)->first();
        $walletAmount = $user->wallet_amount;
        $planAmount =  $plan->amount;
        // wallet balance check for plan subscription
        if($walletAmount < $planAmount){
            return redirect()->back()->with(['error' => "Wallet amount is low please add fund"]);
        }
        $mainSponsorUser = Generation::where('member_id',Auth::user()->id)->first();
        $parentUser = User::findOrFail($mainSponsorUser->main_sponsor_user_id);
        
        $levels = Level::where('status',1)->get();
        $levelUsers = $this->level_distribution(Auth::user()->sponser_code,count($levels));
        //subsciption data insert
        $subscription = new Subscription();
        $subscription->global_plan_id = $request->plan_id;
        $subscription->amount = $planAmount;
        $subscription->user_id = Auth::user()->id;
        $subscription->save();
        if($subscription){
            //automation table data
            $automation = new Automation();
            $automation->global_plan_id = $request->plan_id;
            $automation->user_id = Auth::user()->id;
            $automation->type = 1;
            $automation->save();
            //current user wallet update
            $user->wallet_amount = $user->wallet_amount - $planAmount;
            $user->save();
            //debit passbook current user
            $debitPassbook = new Passbook();
            $debitPassbook->credit_amount = 0;
            $debitPassbook->debit_amount = $planAmount;
            $debitPassbook->current_balance = $user->wallet_amount;
            $debitPassbook->user_id = Auth::user()->id;
            $debitPassbook->purpose = 'Plan Subscription debit '.$planAmount. ' by '.$user->name;
            $debitPassbook->save();
            //direct user bonus
            if($parentUser){
                $setting = Setting::find(1);
                //parent user wallet update by direct bonus
                $parentUser->wallet_amount = $parentUser->wallet_amount + $setting->direct_bonus;
                $parentUser->save();
                $parentUserWalletAmount = $parentUser->wallet_amount;
                //credit passbook by parent user
                $creditPassbook = new Passbook();
                $creditPassbook->credit_amount = $setting->direct_bonus;
                $creditPassbook->debit_amount = 0;
                $creditPassbook->current_balance = $parentUser->wallet_amount;
                $creditPassbook->user_id = $parentUser->id;
                $creditPassbook->purpose = 'Plan Subscription direct income bonus credit to '.$parentUser->name. ' by '.$user->name;
                $creditPassbook->save();
                //current user amount wallet update
                $user->wallet_amount = $user->wallet_amount - $setting->direct_bonus;
                $user->save();

                $debitPassbook = new Passbook();
                $debitPassbook->credit_amount = 0;
                $debitPassbook->debit_amount = $setting->direct_bonus;
                $debitPassbook->current_balance = $user->wallet_amount;
                $debitPassbook->user_id = Auth::user()->id;
                $debitPassbook->purpose = 'Plan Subscription direct income bonus debit to '.$user->name. ' by '.$parentUser->name;
                $debitPassbook->save();
            }
            //levell distribution income
            if($levelUsers){
                $levelBonus = LevelBonus::where('global_plan_id',$request->plan_id)->first();
                foreach($levelUsers as $levelUser){
                    $distributionUser = User::where('id',$levelUser->id)->first();
                    if($levelUser->id == $parentUser->id){
                        $walletAmount = $parentUserWalletAmount + $levelBonus->amount;
                    }else{
                        $walletAmount = $levelUser->wallet_amount + $levelBonus->amount;
                    }
                    //distributor user update wallet
                    $distributionUser->wallet_amount = $walletAmount;
                    $distributionUser->save();

                    //credit passbook distributor user
                    $creditPassbook = new Passbook();
                    $creditPassbook->credit_amount = $levelBonus->amount;
                    $creditPassbook->debit_amount = 0;
                    $creditPassbook->current_balance = $distributionUser->wallet_amount;
                    $creditPassbook->user_id = $levelUser->id;
                    $creditPassbook->purpose = 'Plan Subscription level income credit to '.$levelUser->name. ' by '.$user->name;
                    $creditPassbook->save();

                    //current user amount debit
                    $user->wallet_amount = $user->wallet_amount - $levelBonus->amount;
                    $user->save();

                    //debit passbook current user
                    $debitPassbook = new Passbook();
                    $debitPassbook->credit_amount = 0;
                    $debitPassbook->debit_amount = $levelBonus->amount;
                    $debitPassbook->current_balance = $user->wallet_amount;
                    $debitPassbook->user_id = Auth::user()->id;
                    $debitPassbook->purpose = 'Plan Subscription level income debit to '.$user->name. ' by '.$levelUser->name;
                    $debitPassbook->save();
                }
            }
        }
        //send notification
        $notificationDetails = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'unique_code' => $user->unique_code,
            'message' => 'New plan subscription suceessfully'
        ];
        $receiverUser = User::where('type',1)->first();
        Notification::send($receiverUser, new PlanSubscriptionNotification($notificationDetails));

        return redirect()->route('user.subscriptions.index')->with(['success' => "Item(s) subscription successfully"]);
       
    }

    function level_distribution($unique_code,$count)
    {
        $mainArr = [];
        $j=0;
         for($i = 0 ; $i < $count && $unique_code!=null; $i++)
        //if($unique_code!=null)
        {
           
            $j++;
            $user = $this->find_sponser_id($unique_code,$j);
            $unique_code = $user->sponser_code;
            // $next_id = $this->find_sponser_id($unique_code);
            // $unique_code = $next_id;
            // return $data['unique_code'] = $unique_code;
            array_push($mainArr,$user);
        }
        return $mainArr;
    }

    private function find_sponser_id($unique_code,$j)
    {
       
        $currentUser = User::where('unique_code',$unique_code)->where('type',2)->first();
        $currentUser->level_demo = $j;
        $sponser_code = $currentUser->sponser_code;
        return $currentUser;
        //return $sponser_code;
        
    }

    public function fetchAmount(Request $request)
    {
        $amount = GlobalPlan::where("id", $request->plan_id)
                                ->value('amount');
        return response()->json($amount);
    }
}
