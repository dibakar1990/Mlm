<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        
        return view('frontend.auth.login');
    }

    protected function credentials(Request $request)
    {
        
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'status' => 1,
            'type' => 2
        ];
    }

    protected function authenticated(Request $request, $user)
    {
        
        Log::info('User login successful.', ['id' => $user->id, 'name' => $user->name]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/login');
    }

    protected function loggedOut(Request $request)
    {
        Log::info('User logout successful.');
    }

    protected function redirectTo()
    {
        return route('user.login');
    }
}
