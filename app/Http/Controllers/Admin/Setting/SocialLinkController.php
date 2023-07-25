<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\SocialLink;
use Response;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::latest('id')->get();
        $activeCount = count($socialLinks);
        $trashedCount = SocialLink::onlyTrashed()->count();
        return view('backend.social-link.index', compact(
            'socialLinks',
            'activeCount',
            'trashedCount'
        ));
    }

    public function create()
    {
        return view('backend.social-link.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'link.required' => 'This field is required',
            'icon.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $social = new SocialLink();
        $social->name = $request->name;
        $social->link = $request->link;
        $social->icon = $request->icon;
        $social->status = 1;
        $social->save();
        return redirect()->route('admin.social-links.index')->with(['success' => "Item(s) added successfully"]);
    }

    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        return view('backend.social-link.edit',compact(
            'socialLink'
        ));
    }

    public function update(Request $request , $id)
    {
        $rules = [
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'link.required' => 'This field is required',
            'icon.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $social = SocialLink::findOrFail($id);
        $social->name = $request->name;
        $social->link = $request->link;
        $social->icon = $request->icon;
        $social->save();
        return redirect()->route('admin.social-links.index')->with(['success' => "Item(s) updated successfully"]);
    }

    public function destroy($id)
    {
        $social = SocialLink::findOrFail($id);
        $social->delete();
        return redirect()->route('admin.social-links.index')->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $social = SocialLink::find($id);
        $social->status = $request->status;
        $social->save();
        if ($social) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function action(Request $request)
    {
        $url = route('admin.social-links.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $social = SocialLink::findOrFail($id);
                $social->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $social = SocialLink::findOrFail($id);
                $social->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }
}
