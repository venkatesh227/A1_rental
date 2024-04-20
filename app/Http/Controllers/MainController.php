<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\userRegister;
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
            $request->session()->put('adminId', $userInfo->id);
            return view('admin.index');
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
        if (session()->has('adminId')) {
            session()->pull('adminId');
            return redirect('login');
        }
    }
    public function user_login()
    {
        return view('auth.userLogin');
    }
    public function user_login_check(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10|numeric',
            'password' => 'required|max:12'
        ]);
        $userInfo = userRegister::where('phone', '=', $request->phone)
            ->where('password', '=', md5($request->password))
            ->first();

        if ($userInfo) {
            $request->session()->put('userId', $userInfo->id);
            $category  = Category::all();
            return view('index', compact('category'));
        } else {
            return back()->with('fail', 'Please enter valid details');
        }
    }
    public function user_logout()
    {
        if (session()->has('userId')) {
            session()->pull('userId');
            return redirect('/');
        }
    }
}
