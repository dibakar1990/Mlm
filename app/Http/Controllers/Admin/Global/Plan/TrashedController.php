<?php

namespace App\Http\Controllers\Admin\Global\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GlobalPlan;
use Response;

class TrashedController extends Controller
{
    public function index()
    {
        $items = GlobalPlan::onlyTrashed()->latest()->get();
        $plans = GlobalPlan::get();
        $activeCount = count($plans);
        $trashedCount = count($items);
        return view('backend.plan.trashed.index', compact(
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
    public function action(Request $request)
    {
        $url = route('admin.plan.trashed.index');
        // 1 is move to restore
        if($request->action_value == 1){
            foreach($request->ids as $id){
                GlobalPlan::onlyTrashed()->find($id)->restore();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            foreach($request->ids as $id){
                $plan = GlobalPlan::onlyTrashed()->findOrFail($id);
                $plan->forceDelete();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        
        $plan = GlobalPlan::onlyTrashed()->find($id);
        $plan->restore();
        return redirect()->route('admin.plan.trashed.index')->with(['success' => "Item(s) restore successfully"]);
    }

    public function destroy($id)
    {
        $plan = GlobalPlan::onlyTrashed()->findOrFail($id);
        $plan->forceDelete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }
}
