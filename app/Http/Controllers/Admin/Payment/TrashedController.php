<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentQR;
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
        $datums = PaymentQR::onlyTrashed()->latest()->get();
        $trashedCount = count($datums);
        $activeCount = PaymentQR::count();
        return view('backend.payment-qr.trashed.index', compact(
            'datums',
            'activeCount',
            'trashedCount'
        ));
    }

    public function action(Request $request)
    {
        $url = route('admin.payment-qr.trashed.index');
        // 1 is move to restore
        if($request->action_value == 1){
            foreach($request->ids as $id){
                PaymentQR::onlyTrashed()->find($id)->restore();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
            
        }else{
            foreach($request->ids as $id){
                $paymentqr = PaymentQR::onlyTrashed()->findOrFail($id);
                $paymentqr->forceDelete();
            }
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
    }

    public function restore($id)
    {
        
        $paymentqr = PaymentQR::onlyTrashed()->find($id);
        $paymentqr->restore();
        return redirect()->back()->with(['success' => "Item(s) restore successfully"]);
    }

    public function destroy($id)
    {
        $paymentqr = PaymentQR::onlyTrashed()->findOrFail($id);
        $paymentqr->forceDelete();
        return redirect()->back()->with(['success' => "Item(s) deleted successfully"]);
    }
}
