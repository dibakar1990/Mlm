<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\GlobalLevel;
use App\Models\GlobalLevelGeneration;
use App\Models\GlobalPlan;
use Response;

class GlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = GlobalLevel::with('globalPlan','globalLevelGeneration')->latest()->get();
        $items = $collections->map(function($item, $key) {
            $collection = collect($item->globalLevelGeneration);
            $level = $collection->implode('level', ', '); 
            $level_name = $collection->implode('level_name', ', '); 
            $item->level = $level; 
            $item->level_name = $level_name; 
            return $item;
         });
        $activeCount = count($items);
        $trashedCount = GlobalLevel::onlyTrashed()->count();
        return view('backend.global.index',compact(
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
        $items = GlobalPlan::where('status',1)->whereNull('deleted_at')->get();
        return view('backend.global.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkData = LevelBonus::where('global_plan_id',$request->plan_id)->onlyTrashed()->first();
       
        if($checkData){
            return redirect()->back()->with(['error' => "Already exist item restore trashed item or delete the trashed item"]);
        }

        $rules = [
            'plan_id' => 'required|unique:global_levels,global_plan_id,NULL,id,deleted_at,NULL'
        ];
        $customMessages = [
            'plan_id.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        if(empty($request->levelValue)){
            return redirect()->back()->with(['error' => "Field the level value"]);
        }else{
            $globalLevel = new GlobalLevel();
            $globalLevel->global_plan_id = $request->plan_id;
            $globalLevel->save();
            if ($request->levelValue) {
                $this->storeGlobalLevelGeneration($request->levelValue, $globalLevel);
            }
            return redirect()->route('admin.globals.index')->with(['success' => "Item(s) added successfully"]);
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = GlobalLevel::with('globalPlan','globalLevelGeneration')->findOrFail($id);
        return view('backend.global.view',compact(
            'data'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = GlobalLevel::with('globalPlan','globalLevelGeneration')->findOrFail($id);
        //dd($data);
        $items = GlobalPlan::where('status',1)->whereNull('deleted_at')->get();
        return view('backend.global.edit',compact(
            'data',
            'items'
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
            'plan_id'=>'required|unique:global_levels,global_plan_id,'.$id.',id,deleted_at,NULL'
        ];
        $customMessages = [
            'plan_id.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if(empty($request->levelValue)){
            return redirect()->back()->with(['error' => "Any One Field the level value"]);
        }else{
            $levelGenerationIDs = GlobalLevelGeneration::where('global_level_id',$id)->pluck('id')->toArray();
            $globalLevel = GlobalLevel::findOrFail($id);
            $globalLevel->global_plan_id = $request->plan_id;
            $globalLevel->save();
            
            if ($request->levelValue) {
                GlobalLevelGeneration::whereIn('id',$levelGenerationIDs)->forceDelete();
                $this->storeGlobalLevelGeneration($request->levelValue, $globalLevel);
            }
            return redirect()->route('admin.globals.index')->with(['success' => "Item(s) added successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $globalLevel = GlobalLevel::findOrFail($id)->forceDelete();
        $levelGenerationIDs = GlobalLevelGeneration::where('global_level_id',$id)->pluck('id')->toArray();
        if($globalLevel){
            GlobalLevelGeneration::whereIn('id',$levelGenerationIDs)->forceDelete();
        }
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $globalLevel = GlobalLevel::find($id);
        $globalLevel->status = $request->status;
        $globalLevel->save();
        if ($globalLevel) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    private function storeGlobalLevelGeneration(array $levelValue, GlobalLevel $globalLevel)
    {
        
        foreach ($levelValue as $val) {
            $levelgeneration = new GlobalLevelGeneration();
            $levelgeneration->level = $val['level'];
            $levelgeneration->level_name = 'Level-'.$val['level'];
            $levelgeneration->team = $val['team'];
            $levelgeneration->amount = $val['income'];
            $levelgeneration->total_amount = $val['team'] * $val['income'];
            $levelgeneration->recycle = $val['recycle'];
            $levelgeneration->upgrade = $val['upgrade'];
            $levelgeneration->double_recycle = $val['double_recycle'];
            $levelgeneration->direct = $val['direct'];
            $globalLevel->globalLevelGeneration()->save($levelgeneration);
        }
    }
}
