<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\ProfileAssessmentTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PaymentReceiptMail;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function logout()
    {
        Auth::guard('candidate')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return to_route('login');
    }

    public function testList()
    {
        $totalQuestions = \App\Models\QuestionBank::count();
        $tests = ProfileAssessmentTest::with('paymentTransaction')
            ->withCount('scores')
            ->whereCandidateId(Auth::guard('candidate')->id())
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('user.test_list', compact('tests', 'totalQuestions'));
    }

    public function paymentSuccess(Request $request)
    {
        // Check if the transaction was successful
        if ($request->err_code !== "000") {
            Session::flash('error', 'Payment failed. Please try again.');
            return redirect()->route('assessment.test.list');
        }

        $candidateId = Auth::guard('candidate')->id();

        // Verify the test record exists and belongs to the authenticated candidate
        $enrollment = ProfileAssessmentTest::find($request->basket_id);
        if (!$enrollment || (string) $enrollment->candidate_id !== (string) $candidateId) {
            Session::flash('error', 'Invalid payment reference. Please contact support.');
            return redirect()->route('assessment.test.list');
        }

        // Guard against double-processing an already-paid record
        if ($enrollment->payment_status === 'paid') {
            Session::flash('success', 'Your test is already active. Go to the "My Test" tab to begin.');
            return redirect()->route('assessment.test.list');
        }

        $enrollment->payment_status = 'paid';
        // $couponId = Session::pull('applied_coupon_id_'.$request->basket_id.$candidateId);
        // $enrollment->coupon_id = $couponId;
        // $enrollment->test_id = isset($lastTestId) ? ((int) $lastTestId + 1) : date("Y") . '5120000725';
        $enrollment->save();

        // Record transaction details
        $payment = new PaymentTransaction();
        $payment->transaction_id       = $request->transaction_id;
        $payment->quiz_id              = $request->basket_id;
        $payment->candidate_id         = $candidateId;
        $payment->enrollment_date      = $request->order_date;
        $payment->payment_type         = $request->PaymentType;
        $payment->payment_name         = $request->PaymentName;
        $payment->transaction_amount   = $request->merchant_amount;
        $payment->issuer_name          = $request->issuer_name;
        $payment->transaction_currency = $request->transaction_currency;
        $payment->mobile_no            = $request->mobile_no;
        $payment->rdv_message_key      = $request->Rdv_Message_Key;
        $payment->validation_hash      = $request->validation_hash;
        $payment->response_key         = $request->Response_Key;
        $payment->recurring_txn        = $request->Recurring_txn === "False" ? "False" : "True";
        $payment->save();

        // Send payment receipt email
        try {
            $candidate = Auth::guard('candidate')->user();
            Mail::to($candidate->email)->send(new PaymentReceiptMail($candidate, $payment, $enrollment));
        } catch (\Exception $e) {
            \Log::error('Failed to send payment receipt email: ' . $e->getMessage());
        }

        Session::flash('success', 'Your Test Payment has been done successfully. Go to the "My Test" tab to begin your test.');
        return redirect()->route('assessment.test.list');
    }
    public function paymentFailed(Request $request)
    {
        Session::flash('error', 'Payment Failed. Please try again.');
        return redirect()->route('assessment.test.list');
    }

    public function paymentCheckout(Request $request)
    {
        return redirect()->route('assessment.test.list');
    }

    public function paymentHistory()
    {
        $payments = PaymentTransaction::where('candidate_id', Auth::guard('candidate')->id())
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('user.payment_history', compact('payments'));
    }
}
