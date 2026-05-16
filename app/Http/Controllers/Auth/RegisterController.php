<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateProfileAssessmentTestScore;
use App\Models\ProfileAssessmentTest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::guard('candidate')->check()) {
            return to_route('assessment.test.list');
        }
        return view('auth.register');
    }

    public function submitRegistration(Request $request)
    {
        // ✅ Validate directly here
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:candidates,email',
            'password' => 'required|confirmed',
        ]);
        try {
            DB::beginTransaction();
            // 1️⃣ Create User
            $candidate = Candidate::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
            // Send email verification notification
            try {
                $candidate->sendEmailVerificationNotification();
            } catch (\Exception $e) {
                \Log::error('Failed to send verification email on registration: ' . $e->getMessage());
            }
            // Login but require verification
            Auth::guard('candidate')->login($candidate);
            return redirect()->route('verification.notice')->with('success', 'Registration successful! Please check your email to verify your account.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('register')->withInput()->with('error', $e->getMessage());
        }
    }
}
