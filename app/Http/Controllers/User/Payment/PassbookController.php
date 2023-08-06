<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UserPassbookExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Passbook;
use App\Models\Setting;
use Auth, PDF;

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

    public function export()
    {
        return Excel::download(new UserPassbookExport, 'statement.xlsx');
    }

    public function generatePdf()
    {
        $setting = Setting::find(1);
        $datums = Passbook::with('user')
            ->where('user_id',Auth::user()->id)
            ->latest()
            ->get();
  
        
            $pdf = PDF::loadView('pdf.passbook',compact('datums','setting'));
            //download the pdf file
            //return $pdf->download('statement.pdf');
            //view the pdf file
            return $pdf->stream('statement.pdf');
    }

    
}
