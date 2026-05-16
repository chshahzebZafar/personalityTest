<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('assessment.test.list');
        }
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('candidate')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('assessment.test.list')
                ->with('success', 'Login successful');
        }

        return redirect()->route('login')->withInput()
            ->with('error', 'Invalid credentials');
    }
}
