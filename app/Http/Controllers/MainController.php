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

    public function login()
    {
        return view('auth.login');
    }
    public function login_check(Request $request)
    {
        $category = Category::all();

        $request->validate([
            'name' => 'required',
            'password' => 'required|max:12'
        ]);
        $userInfo = User::where('name', '=', $request->name)
            ->where('password', '=', md5($request->password))
            ->first();

        if ($userInfo) {
            $request->session()->put('adminId', $userInfo->id);

            // return view('admin.index');

            return view('admin.category.view', compact('category'));
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
        $category = Category::all();
        // return view('auth.userLogin');
        return view('auth.userLogin', compact( 'category'));
    }

    public function user_login_check(Request $request)
    {
        $status = 1;
        $request->validate([
            'phone' => 'required|digits:10|numeric',
            'password' => 'required|max:12'
        ]);
        $userInfo = userRegister::where('phone', '=', $request->phone)
            ->where('password', '=', md5($request->password))
            ->where('status', '=', $status)
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


    public function register()
    {
        $category = Category::all();
        //         return view('auth.register')
        return view('auth.register', compact( 'category'));
;
    }


    public function add_register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'last_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ], [
            'first_name.required' => 'First Name is Required',
            'first_name.regex' => 'Only spaces and letters are allowed for First Name',
            'last_name.required' => 'Last Name is Required',
            'last_name.regex' => 'Only spaces and letters are allowed for Last Name',
            'phone.required' => 'Phone Number is Required',
            'email.required' => 'Email Id is Required',
            'email.email' => 'Enter a Valid Email Id',
            'password.required' => 'Password is Required',
            'password.min' => 'Password should be at least :min characters long',
            'gender.required' => 'Gender is Required',
            'address.required' => 'Address is Required',
        ]);

        $register = new userRegister;

        $register->first_name = $request->input('first_name');
        $register->last_name = $request->input('last_name');
        $register->phone = $request->input('phone');
        $register->email = $request->input('email');

        $passwordHash = md5($request->input('password'));
        $register->password = $passwordHash;
        $register->gender = $request->input('gender');
        $register->address = $request->input('address');
        $register->save();
        return redirect('user-login')->with('status', "Registered Successfully");
    }
}
