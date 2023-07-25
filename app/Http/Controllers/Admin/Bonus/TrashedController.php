<?php

namespace App\Http\Controllers\Admin\Bonus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelBonus;
use Response;

class TrashedController extends Controller
{
    public function index()
    {
        $items = LevelBonus::with('level')->onlyTrashed()->latest()->get();
        $level = LevelBonus::get();
        $activeCount = count($level);
        $trashedCount = count($items);
        return view('backend.bonus.trashed.index', compact(
            'items',
            'activeCount',
            'trashedCount'
        ));
    }

    public function action(Request $request)
    {
        $url = route('admin.bonus.trashed.index');
        // 1 is move to restore
        if($request->action_value == 1){
            foreach($request->ids as $id){
                LevelBonus::onlyTrashed()->find($id)->restore();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            foreach($request->ids as $id){
                $levelBonus = LevelBonus::onlyTrashed()->findOrFail($id);
                $levelBonus->forceDelete();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }

    public function restore($id)
    {
        
        $levelBonus = LevelBonus::onlyTrashed()->find($id);
        $levelBonus->restore();
        return redirect()->route('admin.bonus.trashed.index')->with(['success' => "Item(s) restore successfully"]);
    }

    public function destroy($id)
    {
        $levelBonus = LevelBonus::onlyTrashed()->findOrFail($id);
        $levelBonus->forceDelete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }
}
