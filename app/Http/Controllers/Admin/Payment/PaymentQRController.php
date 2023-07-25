<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\PaymentQR;
use App\Services\FileService;
use File;
use Hash, Response;

class PaymentQRController extends Controller
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
        $datums = PaymentQR::latest()->get();
        $activeCount = count($datums);
        $trashedCount = PaymentQR::onlyTrashed()->count();
        return view('backend.payment-qr.index', compact(
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
        return view('backend.payment-qr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'currency_name' => 'required',
            'network' => 'required',
            'address' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png',
        ];
        $customMessages = [
            'currency_name.required' => 'This field is required',
            'network.required' => 'This field is required',
            'address.required' => 'This field is required',
            'file.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->hasFile('file')) {
            $uploaded_file = $request->file('file');
            $file_path = $this->fileService->store($uploaded_file, '/QR-Code');
        }

        $paymentQR = new PaymentQR();
        $paymentQR->currency_name = $request->currency_name;
        $paymentQR->network = $request->network;
        $paymentQR->address = $request->address;
        $paymentQR->file_path = $file_path;
        $paymentQR->status = 1;
        $paymentQR->save();
        return redirect()->route('admin.payment-qr.index')->with(['success' => "Item(s) added successfully"]);
    }

    public function show($id)
    {
       //
    }
    
    public function action(Request $request)
    {
        //dd($request->all());
        $url = route('admin.payment-qr.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $PaymentQR = PaymentQR::findOrFail($id);
                $PaymentQR->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $PaymentQR = PaymentQR::findOrFail($id);
                $PaymentQR->forceDelete();
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
        $data = PaymentQR::findOrFail($id);
        return view('backend.payment-qr.edit',compact('data'));
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
            'currency_name' => 'required',
            'network' => 'required',
            'address' => 'required',
        ];
        $customMessages = [
            'currency_name.required' => 'This field is required',
            'network.required' => 'This field is required',
            'address.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $filename = PaymentQR::where('id',$id)->value('file_path');
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

        $paymentQR = PaymentQR::findOrFail($id);
        $paymentQR->currency_name = $request->currency_name;
        $paymentQR->network = $request->network;
        $paymentQR->address = $request->address;
        $paymentQR->file_path = $file_path;
        $paymentQR->save();
        return redirect()->route('admin.payment-qr.index')->with(['success' => "Item(s) updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentQR = PaymentQR::findOrFail($id);
        $paymentQR->delete();
        return redirect()->route('admin.payment-qr.index')->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $paymentQR = PaymentQR::find($id);
        $paymentQR->status = $request->status;
        $paymentQR->save();
        if ($paymentQR) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }
}
