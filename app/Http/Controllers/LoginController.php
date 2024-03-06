<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function indexLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            switch ($user->status) {
                case 'admin':
                    return redirect()->route('dashboard');
                    break;
                case 'user':
                    return redirect()->route('dashboard.user');
                    break;
                case 'manager':
                    return redirect()->route('dashboard.manager');
                    break;
                case 'hq':
                    return redirect()->route('dashboard.hq');
                    break;
                default:
                    return redirect()->route('login');
            }
        }
        return redirect()->route('login')->with('error', 'Login failed! Please check your credentials.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
