<?php

namespace App\Http\Controllers\Admin\Notice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use Response;

class TrashedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Notice::onlyTrashed()->latest()->get();
        $notice = Notice::get();
        $activeCount = count($notice);
        $trashedCount = count($items);
        return view('backend.notice.trashed.index', compact(
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
        $url = route('admin.notice.trashed.index');
        // 1 is move to restore
        if($request->action_value == 1){
            foreach($request->ids as $id){
                Notice::onlyTrashed()->find($id)->restore();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            foreach($request->ids as $id){
                $notice = Notice::onlyTrashed()->findOrFail($id);
                $notice->forceDelete();
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
        
        $notice = Notice::onlyTrashed()->find($id);
        $notice->restore();
        return redirect()->route('admin.notice.trashed.index')->with(['success' => "Item(s) restore successfully"]);
    }

    public function destroy($id)
    {
        $notice = Notice::onlyTrashed()->findOrFail($id);
        $notice->forceDelete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }
}
