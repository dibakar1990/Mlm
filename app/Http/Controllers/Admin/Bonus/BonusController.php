<?php

namespace App\Http\Controllers\Admin\Bonus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\GlobalPlan;
use App\Models\GlobalLevel;
use App\Models\LevelBonus;
use App\Models\Level;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = LevelBonus::with('level','globalPlan')->latest()->get();
        $activeCount = count($datums);
        $trashedCount = LevelBonus::onlyTrashed()->count();
        return view('backend.bonus.index', compact(
            'datums',
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
        $items = Level::where('status',1)->whereNull('deleted_at')->get();
        $plans = GlobalPlan::where('status',1)->whereNull('deleted_at')->get();
        return view('backend.bonus.create',compact('items','plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkData = LevelBonus::where('level_id',$request->level_id)->onlyTrashed()->first();
       
        if($checkData){
            return redirect()->back()->with(['error' => "Already exist item restore trashed item or delete the trashed item"]);
        }

        $rules = [
            'level_id' => 'required|unique:level_bonuses,level_id,NULL,id,deleted_at,NULL',
            'plan_id' => 'required',
            'amount' => 'required|numeric'
        ];
        $customMessages = [
            'level_id.required' => 'This field is required',
            'plan_id.required' => 'This field is required',
            'amount.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $globalLevelID = GlobalLevel::where('global_plan_id',$request->plan_id)->value('id');
        
        $levelBonus = new LevelBonus();
        $levelBonus->level_id = $request->level_id;
        $levelBonus->global_plan_id = $request->plan_id;
        $levelBonus->global_level_id = $globalLevelID;
        $levelBonus->amount = $request->amount;
        $levelBonus->save();
        return redirect()->route('admin.bonus.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Level::where('status',1)->whereNull('deleted_at')->get();
        $plans = GlobalPlan::where('status',1)->whereNull('deleted_at')->get();
        $data = LevelBonus::findOrFail($id);
        return view('backend.bonus.edit',compact(
            'data',
            'items',
            'plans'
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
            'level_id'=>'required|unique:level_bonuses,level_id,'.$id.',id,deleted_at,NULL',
            'plan_id' => 'required',
            'amount' => 'required|numeric'
        ];
        $customMessages = [
            'level_id.required' => 'This field is required',
            'plan_id.required' => 'This field is required',
            'amount.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $globalLevelID = GlobalLevel::where('global_plan_id',$request->plan_id)->value('id');
       
        $levelBonus = LevelBonus::findOrFail($id);
        $levelBonus->level_id = $request->level_id;
        $levelBonus->global_plan_id = $request->plan_id;
        $levelBonus->global_level_id = $globalLevelID;
        $levelBonus->amount = $request->amount;
        $levelBonus->save();
        return redirect()->route('admin.bonus.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $levelBonus = LevelBonus::findOrFail($id);
        $levelBonus->delete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $levelBonus = LevelBonus::find($id);
        $levelBonus->status = $request->status;
        $levelBonus->save();
        if ($levelBonus) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function action(Request $request)
    {
        //dd($request->all());
        $url = route('admin.bonus.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $levelBonus = LevelBonus::findOrFail($id);
                $levelBonus->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $levelBonus = LevelBonus::findOrFail($id);
                $levelBonus->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
        
        
    }
}
