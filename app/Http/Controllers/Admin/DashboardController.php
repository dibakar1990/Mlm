<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUserCount = User::where('type','!=',1)->count();
        $totalBannedUserCount = User::where('type','!=',1)->onlyTrashed()->count();
        $totalActiveUserCount = User::where('type','!=',1)->where('status',1)->count();
        $totalInactiveUserCount = User::where('type','!=',1)->where('status',0)->count();
        return view('backend.dashboard',compact(
            'totalUserCount',
            'totalBannedUserCount',
            'totalActiveUserCount',
            'totalInactiveUserCount'
        ));
    }
}
