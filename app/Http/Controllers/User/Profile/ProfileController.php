<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use File,Hash;

class ProfileController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
       
        $user = User::with('country','state')->find(auth()->user()->id);
        $countries = Country::get();
        $states = State::get();
        
        $shareComponent = \Share::page(
            route('signup.index',['ref_code' => $user->unique_code]),
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        return view('frontend.my-account.index',compact(
            'user',
            'countries',
            'states',
            'shareComponent'
        ))->with(['tab_active' => 'profile']);
    }

    public function update(Request $request,$id=null)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.',id',
            'phone' => 'required|numeric',
            'country_id' => 'required',
            'state_id' => 'required',
            'city' => 'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'email.required' => 'This field is required',
            'phone.required' => 'This field is required',
            'country_id.required' => 'This field is required',
            'state_id.required' => 'This field is required',
            'city.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->with(['tab_active' => 'profile'])->withInput()->withErrors($validator);
        }

        $filename = User::where('id',$id)->value('avatar');
        $path = public_path($filename);

        if($filename){
            $file_path = $filename;
        }else{
            $file_path = null;
        }

        if ($request->hasFile('user_image')) {
            if($filename!='') {
                if(Storage::exists($filename)){
                    Storage::delete($filename);
                }
            }

            $uploaded_file = $request->file('user_image');
            $file_path = $this->fileService->store($uploaded_file, '/profile');
            
        }else{
            $file_path = $filename;
            
        }

        $user =  User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = (!empty($request->phone)) ? $request->phone:null;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city = $request->city;
        $user->avatar = $file_path;
        $user->save();

        return redirect()->back()->with(['success' => "Profile has been updated successfully",'tab_active' => 'profile']);
    }

    public function changePassword(Request $request,$id=null)
    {
        $rules = [
            'old_password' => 'required',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ];

        $customMessages = [
            'old_password.required' => 'This field is required',
            'password.required' => 'This field is required',
            'confirm_password.required' => 'This field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->with(['tab_active' => 'change_password'])->withInput()->withErrors($validator);
        }

        $user = User::findOrFail($id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with(['success' => "Password has been updated successfully",'tab_active' => 'change_password']);
        }else{
            return redirect()->back()->with(['error' => "Old Password Does Not Matched",'tab_active' => 'change_password']);
        }
    }

    
}
