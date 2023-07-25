<?php

namespace App\Http\Controllers\Admin\Notice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Notice;
use App\Services\FileService;
use File;
use Hash;
use Response;

class NoticeController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = Notice::latest()->get();
        $activeCount = count($datums);
        $trashedCount = Notice::onlyTrashed()->count();
        return view('backend.notice.index', compact(
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
        return view('backend.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $file = $request->file('file');
        if(($request->notice_name ==null) && ($file == null))
        {
            return redirect()->back()->with(['error' => "Any one field put the value"]);
        }
        if ($request->hasFile('file')) {
            $uploaded_file = $request->file('file');
            $file_path = $this->fileService->store($uploaded_file, '/notice');
        }

        $notice = new Notice();
        $notice->notice_name = $request->notice_name;
        $notice->file_path = $file_path??null;
        $notice->status = 1;
        $notice->save();
        if($notice){
            //update default status
            Notice::where('id','!=',$notice->id)
                    ->update([
                        'default_status' => 0
                    ]);
        }
        return redirect()->route('admin.notices.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        //dd($request->all());
        $url = route('admin.notices.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $notice = Notice::findOrFail($id);
                $notice->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $notice = Notice::findOrFail($id);
                $notice->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Notice::findOrFail($id);
        return view('backend.notice.edit',compact('data'));
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
        if(($request->notice_name ==null) && ($file == null))
        {
            return redirect()->back()->with(['error' => "Any one field put the value"]);
        }
        
        $filename = Notice::where('id',$id)->value('file_path');
        if ($request->hasFile('file')) {
            if($filename!='') {
                if(Storage::exists($filename)){
                    Storage::delete($filename);
                }
            }
            $uploaded_file = $request->file('file');
            $file_path = $this->fileService->store($uploaded_file, '/QR-Code');
        }else{
            $file_path = $filename;
        }

        $notice = Notice::findOrFail($id);
        $notice->notice_name = $request->notice_name;
        $notice->file_path = $file_path;
        $notice->save();
        return redirect()->route('admin.notices.index')->with(['success' => "Item(s) updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();
        return redirect()->route('admin.notices.index')->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $notice = Notice::find($id);
        $notice->status = $request->status;
        $notice->save();
        if ($notice) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function default_status(Request $request, $id)
    {
        $notice = Notice::find($id);
        $notice->default_status = $request->status;
        $notice->save();
        if ($notice) {
            return redirect()->back()->with('success', 'Item(s) default status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }
}
