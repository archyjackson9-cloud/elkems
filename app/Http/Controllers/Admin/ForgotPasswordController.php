<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Override the reset URL to point at our admin reset route
        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            return url(route('admin.password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        });

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::ResetLinkSent) {
            return back()->with('success', 'A password reset link has been sent to your email address.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
