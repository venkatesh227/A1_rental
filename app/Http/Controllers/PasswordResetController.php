<?php

namespace App\Http\Controllers;

use App\Models\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = UserRegister::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);
            $resetUrl = url('/password/reset/' . $token . '?email=' . urlencode($request->email));

            $email = trim($request->email);

            Mail::send('auth.passwords.emailLink', ['resetUrl' => $resetUrl], function ($message) use ($email) {
                $message->to($email)->subject('Your Password Reset Link');
            });


            if (count(Mail::failures()) > 0) {
                return back()->withErrors(['email' => 'Failed to send password reset link.']);
            } else {
                // Insert the token into the password_resets table
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => now(),
                ]);


                return back()->with(['status' => 'Password reset link sent!']);
            }
        }

        return back()->withErrors(['email' => 'No account found with that email address.']);
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }

    public function reset(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$passwordReset || $passwordReset->email !== $request->email) {
            return back()->withErrors(['email' => 'Invalid token or email address.']);
        }

        $user = UserRegister::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('user-login')->with('status', 'Password has been reset!');
        }

        return back()->withErrors(['email' => 'No account found with that email address.']);
    }
}
