<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Passbook;
use Auth;

class PassbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = Passbook::with('user')
                ->where('user_id',Auth::user()->id)
                ->latest()
                ->get();
        return view('frontend.passbook.index', compact(
            'datums'
        ));
    }
    public function show($id)
    {
        $data = Passbook::with('user')->findOrFail($id);
        return view('frontend.passbook.view', compact(
            'data'
        ));
    }

    
}
