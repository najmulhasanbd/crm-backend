<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('admin.dashboard'))->with([
    //         'message' => 'Welcome back to !',
    //         'alert-type' => 'success'
    //     ]);
    // }
  public function store(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        // Email বা password ভুল হলে
        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ]);
    }

    $user = Auth::user();

    if ($user->status == 0) {
        Auth::logout();
        // session flash message দিয়ে toastr show
        return redirect()->back()->with([
            'message' => 'Your account is inactive. Please contact admin.',
            'alert-type' => 'error'
        ]);
    }

    $request->session()->regenerate();

    return redirect()->intended(route('admin.dashboard'))->with([
        'message' => 'Welcome back!',
        'alert-type' => 'success'
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with([
            'message' => 'Logged out successfully.',
            'alert-type' => 'success'
        ]);
    }
}
