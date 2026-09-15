<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * نمایش فرم ورود
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * پردازش درخواست ورود
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.admins.index'));
        }

        return back()
            ->withErrors(['email' => 'ایمیل یا رمز عبور اشتباه است'])
            ->onlyInput('email');
    }

    /**
     * خروج از حساب کاربری
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
