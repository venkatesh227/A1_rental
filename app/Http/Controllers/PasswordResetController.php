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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',       // must contain at least one uppercase letter
                'regex:/[a-z]/',       // must contain at least one lowercase letter
                'regex:/[0-9]/',       // must contain at least one digit
                'regex:/[@$!%*#?&]/',  // must contain a special character
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'token.required' => 'The token is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password_confirmation.required' => 'The password confirmation field is required.',
            'password_confirmation.same' => 'The password confirmation does not match.',
        ]);
        

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$passwordReset || $passwordReset->email !== $request->email) {
            return back()->withErrors(['email' => 'Invalid token or email address.']);
        }

        $user = UserRegister::where('email', $request->email)->first();
        if ($user) {

            if ($user->password == md5($request->password)) {
                return back()->withErrors(['password' => 'The previous password and current password must be different.']);
            }

            $user->password = md5($request->password);
            $user->save();

            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('user-login')->with('status', 'Password has been reset!');
        }

        return back()->withErrors(['email' => 'No account found with that email address.']);
    }
}
