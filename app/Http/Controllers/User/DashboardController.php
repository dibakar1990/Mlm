<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Generation;
use App\Models\User;
use Auth;

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
        // Total user Count
        $usersIDs = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->pluck('member_id');
        $totalUserCount = User::whereIn('id',$usersIDs)->count();
        // Total Active User Count
        $totalActiveUserCount = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->whereRelation('user', 'status', 1)
            ->count();
        // Total Inactive User Count
        $totalInactiveUserCount = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->whereRelation('user', 'status', 0)
            ->count();
        // Total Banned User Count
        $totalBannedUserCount = Generation::with('user')
            ->whereHas('user', function ($query) {
                $query->onlyTrashed();
            })
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->count();
        
        return view('frontend.dashboard.index',compact(
            'shareComponent',
            'notice',
            'totalUserCount',
            'totalActiveUserCount',
            'totalInactiveUserCount',
            'totalBannedUserCount'
        ));
    }
}
