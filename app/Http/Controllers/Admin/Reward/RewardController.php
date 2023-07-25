<?php

namespace App\Http\Controllers\Admin\Reward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\RewardBonus;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RewardBonus::latest()->get();
        $activeCount = count($items);
        $trashedCount = RewardBonus::onlyTrashed()->latest()->count();
        return view('backend.reward.index',compact(
            'items',
            'activeCount',
            'trashedCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reward.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $checkData = RewardBonus::where('rank_name',$request->rank_name)->onlyTrashed()->first();
       
        if($checkData){
            return redirect()->back()->with(['error' => "Already exist item restore trashed item or delete the trashed item"]);
        }
        
        $rules = [
            'rank_name' => 'required|unique:reward_bonuses,rank_name,NULL,id',
            'a_team' => 'required',
            'b_team' => 'required',
            'c_team' => 'required',
            'amount' => 'required|numeric',
            'days' => 'required',
        ];
        $customMessages = [
            'rank_name.required' => 'This field is required',
            'a_team.required' => 'This field is required',
            'b_team.required' => 'This field is required',
            'c_team.required' => 'This field is required',
            'amount.required' => 'This field is required',
            'days.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        // add fund insert data
        $reward = new RewardBonus();
        $reward->rank_name = $request->rank_name;
        $reward->a_team = $request->a_team;
        $reward->b_team = $request->b_team;
        $reward->c_team = $request->c_team;
        $reward->amount = $request->amount;
        $reward->days = $request->days;
        $reward->save();
        return redirect()->route('admin.rewards.index')->with(['success' => "Item(s) added successfully"]);
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
        $data = RewardBonus::findOrFail($id);
        return view('backend.reward.edit',compact(
            'data'
        ));
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
        $rules = [
            'rank_name'=>'required|unique:reward_bonuses,rank_name,'.$id.',id,deleted_at,NULL',
            'a_team' => 'required',
            'b_team' => 'required',
            'c_team' => 'required',
            'amount' => 'required|numeric',
            'days' => 'required',
        ];
        $customMessages = [
            'rank_name.required' => 'This field is required',
            'a_team.required' => 'This field is required',
            'b_team.required' => 'This field is required',
            'c_team.required' => 'This field is required',
            'amount.required' => 'This field is required',
            'days.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
       
        $reward = RewardBonus::findOrFail($id);
        $reward->rank_name = $request->rank_name;
        $reward->a_team = $request->a_team;
        $reward->b_team = $request->b_team;
        $reward->c_team = $request->c_team;
        $reward->amount = $request->amount;
        $reward->days = $request->days;
        $reward->save();
        return redirect()->route('admin.rewards.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward = RewardBonus::findOrFail($id);
        $reward->delete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $reward = RewardBonus::find($id);
        $reward->status = $request->status;
        $reward->save();
        if ($reward) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function action(Request $request)
    {
        //dd($request->all());
        $url = route('admin.rewards.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $reward = RewardBonus::findOrFail($id);
                $reward->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $reward = RewardBonus::findOrFail($id);
                $reward->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }
}
