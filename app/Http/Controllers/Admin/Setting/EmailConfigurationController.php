<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\EmailConfiguration;

class EmailConfigurationController extends Controller
{
    public function edit($id)
    {
        $emailConfiguration = EmailConfiguration::find(1);
        return view('backend.email-configuration.edit',compact('emailConfiguration'));
    }

    public function update(Request $request , $id)
    {
        $rules = [
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required|email',
            'password' => 'required',
            'encryption' => 'required',
            'from_address' => 'required|email',
            'from_name' => 'required',
        ];
        $customMessages = [
            'driver.required' => 'This field is required',
            'host.required' => 'This field is required',
            'port.required' => 'This field is required',
            'username.required' => 'This field is required',
            'password.required' => 'This field is required',
            'encryption.required' => 'This field is required',
            'from_address.required' => 'This field is required',
            'from_name.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        
        
        $emailConfiguration =  EmailConfiguration::findOrFail($id);
        $emailConfiguration->driver = $request->driver;
        $emailConfiguration->host = $request->host;
        $emailConfiguration->port = $request->port;
        $emailConfiguration->user_name = $request->username;
        $emailConfiguration->password = $request->password;
        $emailConfiguration->encryption = $request->encryption;
        $emailConfiguration->from_address = $request->from_address;
        $emailConfiguration->from_name = $request->from_name;
        $emailConfiguration->save();

        return redirect()->back()->with(['success' => "Item(s) updated successfully"]);
    
    }
}
