<?php

namespace App\Http\Controllers\Admin\Bonus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\Level;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = Level::latest()->get();
        $activeCount = count($datums);
        $trashedCount = Level::onlyTrashed()->count();
        return view('backend.level.index', compact(
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
        return view('backend.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkData = LevelBonus::where('name',$request->name)->onlyTrashed()->first();
       
        if($checkData){
            return redirect()->back()->with(['error' => "Already exist item restore trashed item or delete the trashed item"]);
        }

        $rules = [
            'name' => 'required|unique:levels,name,NULL,id,deleted_at,NULL'
        ];
        $customMessages = [
            'name.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        // add fund insert data
        $level = new Level();
        $level->name = $request->name;
        $level->save();
        return redirect()->route('admin.levels.index')->with(['success' => "Item(s) added successfully"]);
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Level::findOrFail($id);
        return view('backend.level.edit',compact(
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
            'name'=>'required|unique:levels,name,'.$id.',id,deleted_at,NULL'
        ];
        $customMessages = [
            'name.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
       
        $level = Level::findOrFail($id);
        $level->name = $request->name;
        $level->save();
        return redirect()->route('admin.levels.index')->with(['success' => "Item(s) added successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $level = Level::find($id);
        $level->status = $request->status;
        $level->save();
        if ($level) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function action(Request $request)
    {
        //dd($request->all());
        $url = route('admin.levels.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $level = Level::findOrFail($id);
                $level->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $level = Level::findOrFail($id);
                $level->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
        
        
    }
}
