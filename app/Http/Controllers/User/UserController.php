<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $users = User::where('sponser_code',Auth::user()->unique_code)->latest()->get();
        return view('frontend.user.index',compact('users'));
    }

    public function show($id)
    {
        $data = User::with('country','state')->find($id);
        return view('frontend.user.view',compact('data'));
    }

}
