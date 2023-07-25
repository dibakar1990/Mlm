<?php

namespace App\Http\Controllers\Admin\Reward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RewardBonus;
use Response;

class TrashedController extends Controller
{
    public function index()
    {
        $items = RewardBonus::onlyTrashed()->latest()->get();
        $plans = RewardBonus::get();
        $activeCount = count($plans);
        $trashedCount = count($items);
        return view('backend.reward.trashed.index', compact(
            'items',
            'activeCount',
            'trashedCount'
        ));
    }

    public function action(Request $request)
    {
        $url = route('admin.reward.trashed.index');
        // 1 is move to restore
        if($request->action_value == 1){
            foreach($request->ids as $id){
                RewardBonus::onlyTrashed()->find($id)->restore();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            foreach($request->ids as $id){
                $reward = RewardBonus::onlyTrashed()->findOrFail($id);
                $reward->forceDelete();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }

   
    public function restore($id)
    {
        
        $reward = RewardBonus::onlyTrashed()->find($id);
        $reward->restore();
        return redirect()->route('admin.reward.trashed.index')->with(['success' => "Item(s) restore successfully"]);
    }

    public function destroy($id)
    {
        $reward = RewardBonus::onlyTrashed()->findOrFail($id);
        $reward->forceDelete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }
}
