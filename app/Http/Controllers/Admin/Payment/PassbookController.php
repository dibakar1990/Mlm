<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Passbook;
use App\Models\Setting;
use App\Exports\UsersPassbookExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PassbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datums = Passbook::with('user')->latest()->get();
        return view('backend.passbook.index', compact(
            'datums'
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
        $data = Passbook::with('user')->findOrFail($id);
        return view('backend.passbook.view', compact(
            'data'
        ));
    }

    public function export()
    {
        return Excel::download(new UsersPassbookExport, 'statement.xlsx');
    }

    public function generatePdf()
    {
        $setting = Setting::find(1);
        $datums = Passbook::with('user')
            ->latest()
            ->get();
  
        
            $pdf = PDF::loadView('pdf.passbook',compact('datums','setting'));
            //download the pdf file
            //return $pdf->download('statement.pdf');
            //view the pdf file
            return $pdf->stream('statement.pdf');
    }
}
