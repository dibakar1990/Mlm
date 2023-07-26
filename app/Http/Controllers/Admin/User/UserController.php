<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Passbook;
use App\Models\PaymentRequest;
use App\Models\User;
use Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type',2)->latest('id')->get();
        $activeCount = count($users);
        $trashedCount = User::onlyTrashed()->count();
        return view('backend.user.index',compact(
            'users',
            'activeCount',
            'trashedCount'
        ));
    }

    public function active()
    {
        $users = User::where('type',2)->where('status',1)->latest('id')->get();
        $activeCount = count($users);
        $trashedCount = User::onlyTrashed()->count();
        return view('backend.user.index',compact(
            'users',
            'activeCount',
            'trashedCount'
        ));
    }

    public function inactive()
    {
        $users = User::where('type',2)->where('status',0)->latest('id')->get();
        $activeCount = count($users);
        $trashedCount = User::onlyTrashed()->count();
        return view('backend.user.index',compact(
            'users',
            'activeCount',
            'trashedCount'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('country','state')->find($id);
        return view('backend.user.view',compact('user'));
    }

    public function banned()
    {
        $items = User::onlyTrashed()->latest()->get();
        $users = User::where('type',2)->latest('id')->get();
        $activeCount = count($users);
        $trashedCount = count($items);
        return view('backend.user.banned.index',compact(
            'items',
            'activeCount',
            'trashedCount'
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $fundCount = Fund::where('user_id',$id)->count();
        $paymentRequestCount = PaymentRequest::where('user_id',$id)->count();
        $passbookCount = Passbook::where('user_id',$id)->count();
        if (($fundCount > 0) || ($paymentRequestCount > 0) || ($passbookCount > 0)) {
            return redirect()->back()->with('error', 'You can not delete it. Because it has some transaction.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with(['success' => "Item(s) deleted successfully"]);
    }

    public function status(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = $request->status;
        $user->save();
        if ($user) {
            return redirect()->back()->with('success', 'Item(s) status changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    

    public function action(Request $request)
    {
       
        $url = route('admin.users.index');
        
        // 1 is move to trashed
        if($request->action_value == 1){
            foreach($request->ids as $id){
                $user = User::findOrFail($id);
                $fundCount = Fund::where('user_id',$id)->count();
                $paymentRequestCount = PaymentRequest::where('user_id',$id)->count();
                $passbookCount = Passbook::where('user_id',$id)->count();
                $trashedCount = User::onlyTrashed()->count();
                $activeCount = User::where('type',2)->count();
                if(($fundCount > 0) || ($paymentRequestCount > 0) || ($passbookCount > 0)){
                    return Response::json(['status'=>false,'activeCount'=>$activeCount,'trashedCount'=>$trashedCount,'msg'=>'Some User can not delete it. Because it has some transaction.']);
                }
                $user->delete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'activeCount'=>$activeCount,'trashedCount'=>$trashedCount,'msg'=>'Action has been completed.']);
            
        }else{
            // delete permanently
            foreach($request->ids as $id){
                $user = User::findOrFail($id);
                $fundCount = Fund::where('user_id',$id)->count();
                $paymentRequestCount = PaymentRequest::where('user_id',$id)->count();
                $passbookCount = Passbook::where('user_id',$id)->count();
                if(($fundCount > 0) || ($paymentRequestCount > 0) || ($passbookCount > 0)){
                    return Response::json(['status'=>false,'msg'=>'Some User can not delete it. Because it has some transaction.']);
                }
                $user->forceDelete();
            }
            
            return Response::json(['status'=>true,'url'=>$url,'msg'=>'Action has been completed.']);
        }
        
        
    }
}
