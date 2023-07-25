<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersIDs = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->pluck('member_id');
        $users = User::whereIn('id',$usersIDs)->latest()->get();
        $totalCount = count($users);
        return view('frontend.user.index',compact(
            'users',
            'totalCount'
        ));
    }

    public function show($id)
    {
        $data = User::with('country','state')->find($id);
        return view('frontend.user.view',compact('data'));
    }

    public function active()
    {
        $usersIDs = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->pluck('member_id');
        $users = User::whereIn('id',$usersIDs)->where('status',1)->latest()->get();
        $totalCount = count($users);
        return view('frontend.user.index',compact(
            'users',
            'totalCount'
        ));
    }

    public function inactive()
    {
        $usersIDs = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->pluck('member_id');
        $users = User::whereIn('id',$usersIDs)->where('status',0)->latest()->get();
        $totalCount = count($users);
        return view('frontend.user.index',compact(
            'users',
            'totalCount'
        ));
    }

    public function banned()
    {
        $usersIDs = Generation::with('user')
            ->where('main_sponsor_user_id',Auth::user()->id)
            ->pluck('member_id');
        $users = User::whereIn('id',$usersIDs)->onlyTrashed()->latest()->get();
        $totalCount = count($users);
        return view('frontend.user.index',compact(
            'users',
            'totalCount'
        ));
    }
    

}
