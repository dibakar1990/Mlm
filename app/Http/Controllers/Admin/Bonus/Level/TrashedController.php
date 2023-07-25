<?php

namespace App\Http\Controllers\Admin\Bonus\Level;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use Response;

class TrashedController extends Controller
{
    public function index()
    {
        $items = Level::onlyTrashed()->latest()->get();
        $level = Level::get();
        $activeCount = count($level);
        $trashedCount = count($items);
        return view('backend.level.trashed.index', compact(
            'items',
            'activeCount',
            'trashedCount'
        ));
    }

    public function action(Request $request)
    {
        $url = route('admin.level.trashed.index');
        // 1 is move to restore
        if($request->action_value == 1){
            foreach($request->ids as $id){
                Level::onlyTrashed()->find($id)->restore();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            foreach($request->ids as $id){
                $level = Level::onlyTrashed()->findOrFail($id);
                $level->forceDelete();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }

    public function restore($id)
    {
        
        $level = Level::onlyTrashed()->find($id);
        $level->restore();
        return redirect()->route('admin.level.trashed.index')->with(['success' => "Item(s) restore successfully"]);
    }

    public function destroy($id)
    {
        $level = Level::onlyTrashed()->findOrFail($id);
        $level->forceDelete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }
}
