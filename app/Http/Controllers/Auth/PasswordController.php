<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // পাসওয়ার্ড সফলভাবে পরিবর্তনের পর ইউজারকে লগআউট করা
        Auth::logout();

        // সেশন ইনভ্যালিডেট ও CSRF টোকেন রিজেনারেট করা
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // লগইন পেজে রিডিরেক্ট, toastr মেসেজ সহ
        return redirect('/login')->with([
            'message' => 'Password changed successfully! Please login again.',
            'alert-type' => 'success',
        ]);
    }
}
