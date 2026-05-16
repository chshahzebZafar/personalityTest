<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Mail\PersonalityTestResultMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        // Email verify karega
        $request->fulfill();

        // Candidate guard se login
        Auth::guard('candidate')->login($request->user());
        // Send email after successful verification (without PDF)
        $candidate = Auth::guard('candidate')->user();
        $this->sendPersonalityResultEmail($candidate);

        return redirect()->route('assessment.test.list')
            ->with('success', 'Email verified and logged in successfully.');
    }
    
     /**
     * Send personality test result email (without PDF attachment)
     */
    protected function sendPersonalityResultEmail($candidate)
    {
        try {
            // Fetch candidate's personality test results from database
            $personalityTest = $candidate->personalityTest()->latest()->first();
            
            // Generate unique offer code
            // $offerCode = $this->generateOfferCode($candidate);
            
            // Send email
            Mail::to($candidate->email)->send(new PersonalityTestResultMail($candidate, $personalityTest));
            
        } catch (\Exception $e) {
            \Log::error('Failed to send personality result email: ' . $e->getMessage());
        }
    }
}
