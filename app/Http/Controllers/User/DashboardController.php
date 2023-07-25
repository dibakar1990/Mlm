<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::with('country','state')->find(auth()->user()->id);
        $shareComponent = \Share::page(
            route('signup.index',['ref_code' => $user->unique_code]),
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        $notice = Notice::whereNull('deleted_at')
                ->where('status',1)
                ->where('default_status',1)
                ->latest()
                ->first();
        return view('frontend.dashboard.index',compact(
            'shareComponent',
            'notice'
        ));
    }
}
