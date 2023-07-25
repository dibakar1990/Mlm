<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;
use App\Models\Setting;

class SettingController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

   
    public function edit($id)
    {
        $setting = Setting::find(1);
    
        return view('backend.setting.edit',compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'bonus' => 'required',
        ];
        $customMessages = [
            'title.required' => 'This field is required',
            'email.required' => 'This field is required',
            'phone.required' => 'This field is required',
            'address.required' => 'This field is required',
            'bonus.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $filename = Setting::where('id',$id)->value('file_path_squre');
        
        if ($request->hasFile('image')) {
            if($filename!='') {
                if(Storage::exists($filename)){
                    Storage::delete($filename);
                }
            }

            $uploaded_file = $request->file('image');
            $file_path_squre = $this->fileService->store($uploaded_file, '/logo');
           
        }else{
            $file_path_squre = $filename;
        }

        $filenameVertical = Setting::where('id',$id)->value('file_path_vertical');
        if ($request->hasFile('file')) {
            if($filenameVertical!='') {
                if(Storage::exists($filenameVertical)){
                    Storage::delete($filenameVertical);
                }
            }

            $uploaded_file_vertical = $request->file('file');
            $file_path_vertical = $this->fileService->store($uploaded_file_vertical, '/logo');
           
        }else{
            $file_path_vertical = $filenameVertical;
        }
        
        $setting =  Setting::findOrFail($id);
        $setting->title = $request->title;
        $setting->email = $request->email;
        $setting->mobile_number = $request->phone;
        $setting->address = $request->address;
        $setting->file_path_squre = $file_path_squre;
        $setting->file_path_vertical = $file_path_vertical;
        $setting->direct_bonus = $request->bonus;
        $setting->save();

        return redirect()->back()->with(['success' => "Item(s) updated successfully"]);
    }
}
