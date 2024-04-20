<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller

{
    protected function authenticated()
    {
        if (Auth::User()->role_as == '1') //1 = Admin Login
        {
            return redirect('admin.dashboard')->with('status', 'Welcome to your dashboard');
        } elseif (Auth::User()->role_as == '0') // Normal or Default User Login
        {
            return redirect('/')->with('status', 'Logged in successfully');
        }
    }
    public function login()
    {
        return view('auth.login');
    }
    public function login_check(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|max:12'
        ]);
        $userInfo = User::where('name', '=', $request->name)
            ->where('password', '=', md5($request->password))
            ->first();

        if ($userInfo) {
            $request->session()->put('userId', $userInfo->id);
            
            return redirect('categories');
        } else {
            return back()->with('fail', 'Please enter valid details');
        }

    }

    public function dashboard()
    {
        return view('admin.category.addcategory');
    }

    public function logout()
    {
        if (session()->has('userId')) {
            session()->pull('userId');
            return redirect('login');
        }
    }
}
