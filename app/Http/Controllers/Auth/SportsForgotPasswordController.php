<?php

namespace App\Http\Controllers\Auth;

use App\Models\ums\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SportsPasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SportsForgotPasswordController extends Controller
{
    // Show forgot password form
    public function showForgotForm()
    {
        return view('ums.sports.forgot-password');
    }

    // Send reset link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found in our records.');
        }

        // Generate token
        $token = Str::random(60);
        $user->password_reset_token = $token;
        $user->password_reset_at = Carbon::now();
        $user->save();

        // Send email
        $resetLink = route('sports.password.reset', $token);
        Mail::to($user->email)->send(new SportsPasswordResetMail($resetLink));

        return back()->with('status', 'Password reset link sent to your email!');
    }

    // Show reset password form
    public function showResetForm($token)
    {
        $user = User::where('password_reset_token', $token)
            ->where('password_reset_at', '>', Carbon::now()->subHours(2))
            ->first();

        if (!$user) {
            return redirect()->route('sports.password.request')
                ->with('error', 'Invalid or expired reset link.');
        }

        return view('ums.sports.reset-password', ['token' => $token, 'email' => $user->email]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)
            ->where('password_reset_token', $request->token)
            ->where('password_reset_at', '>', Carbon::now()->subHours(2))
            ->first();

        if (!$user) {
            return back()->with('error', 'Invalid or expired reset link.');
        }

        $user->password = Hash::make($request->password);
        $user->password_reset_token = null;
        $user->password_reset_at = null;
        $user->save();

        return redirect()->route('sports.login')
            ->with('success', 'Password reset successfully! Please login.');
    }
}