<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\GlobalPlan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = GlobalPlan::latest()->get();
        $activeCount = count($items);
        $trashedCount = GlobalPlan::onlyTrashed()->latest()->count();
        return view('backend.plan.index',compact(
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
        return view('backend.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkData = GlobalPlan::where('plan_name',$request->plan_name)->onlyTrashed()->first();
       
        if($checkData){
            return redirect()->back()->with(['error' => "Already exist item restore trashed item or delete the trashed item"]);
        }

        $rules = [
            'plan_name' => 'required|unique:global_plans,plan_name,NULL,id,deleted_at,NULL',
            'amount' => 'required|numeric'
        ];
        $customMessages = [
            'plan_name.required' => 'This field is required',
            'amount.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        // add fund insert data
        $plan = new GlobalPlan();
        $plan->plan_name = $request->plan_name;
        $plan->amount = $request->amount;
        $plan->save();
        return redirect()->route('admin.plans.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $data = GlobalPlan::findOrFail($id);
        return view('backend.plan.edit',compact(
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
            'plan_name'=>'required|unique:global_plans,plan_name,'.$id.',id,deleted_at,NULL',
            'amount' => 'required|numeric'
        ];
        $customMessages = [
            'plan_name.required' => 'This field is required',
            'amount.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
       
        $plan = GlobalPlan::findOrFail($id);
        $plan->plan_name = $request->plan_name;
        $plan->amount = $request->amount;
        $plan->save();
        return redirect()->route('admin.plans.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = GlobalPlan::findOrFail($id);
        $plan->delete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $plan = GlobalPlan::find($id);
        $plan->status = $request->status;
        $plan->save();
        if ($plan) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function action(Request $request)
    {
        //dd($request->all());
        $url = route('admin.plans.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $plan = GlobalPlan::findOrFail($id);
                $plan->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $plan = GlobalPlan::findOrFail($id);
                $plan->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
        
        
    }
}
