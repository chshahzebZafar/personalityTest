<?php

namespace App\Http\Controllers;

use App\Models\ProfileAssessmentTest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RTCATUpgradeOffer;
use Illuminate\Support\Facades\Session;

class ResultController extends Controller
{
    public function downloadResult($quiz_id)
    {
        $candidateId  = Auth::guard('candidate')->id();
        $checkFeePaid = ProfileAssessmentTest::find($quiz_id);

        // Ensure the record exists and belongs to the authenticated candidate
        if (!$checkFeePaid || (string) $checkFeePaid->candidate_id !== (string) $candidateId) {
            abort(403, 'You are not authorised to access this result.');
        }

        $fee = $this->testFee();

        if ($fee > 0 && $checkFeePaid->payment_status == 'unpaid') {

            $token = getAccessToken($fee, $quiz_id);

            return view('user.payment', [
                'quiz'      => $quiz_id,
                'quiz_id'   => $quiz_id,
                'fee'       => $fee,
                'token'     => $token,
                'coupon_id' => '',
            ]);
        }

        return $this->generateQuizReport($quiz_id);
    }

    public function generateQuizReport($quizId)
    {
        try {
            $candidate = Auth::guard('candidate')->user();
            if (!$candidate) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $assessmentResponse = candidateProfileAssessmentCharts($quizId, $candidate->id)->getData(true);

            $errorMessage = '';
            $assessmentResult = [];
            $jobRolesData = [];
            if ($assessmentResponse['status'] === 'error') {
                $errorMessage = $assessmentResponse['message'];
            } else {
                $assessmentResult = $assessmentResponse['data'];
                $jobRoles = findJobRole($assessmentResult);
                $jobRolesData = $jobRoles->getData(true);
                $quizDate = strtoupper(ProfileAssessmentTest::find($quizId)->created_at
    ->format('F, d Y'));
            }
            $pdf = Pdf::loadView('pdf.result-pdf', compact(
                'quizId',
                'quizDate',
                'jobRolesData',
                'candidate',
                'errorMessage'
            ));
            // === SEND RTCAT OFFER EMAIL AFTER DOWNLOAD ===
            $this->sendRTCATOfferEmail($candidate);

            return $pdf->download('profile_report.pdf');

        } catch (\Exception $exception) {
            Session::flash('error', 'Facing error. Please try again.');
            return back();
        }
    }

    /**
 * Send RTCAT upgrade offer email to candidate
 */
private function sendRTCATOfferEmail($candidate)
{
    try {
        // Check if candidate has email
        if (!$candidate->email) {
            \Log::warning('RTCAT offer not sent: Candidate has no email', ['candidate_id' => $candidate->id]);
            return;
        }

        $cacheKey = 'rtcat_offer_sent_' . $candidate->id;
        if (cache()->has($cacheKey)) {
            \Log::info('RTCAT offer already sent to candidate', ['candidate_id' => $candidate->id, 'email' => $candidate->email]);
            return;
        }

        // Send email
        Mail::to($candidate->email)->send(new RTCATUpgradeOffer($candidate));

        cache()->put($cacheKey, true, now()->addDays(14));

        \Log::info('RTCAT offer email sent successfully', ['candidate_id' => $candidate->id, 'email' => $candidate->email]);

    } catch (\Exception $e) {
        // Log error but don't break the PDF download flow
        \Log::error('Failed to send RTCAT offer email', [
            'candidate_id' => $candidate->id ?? null,
            'error' => $e->getMessage()
        ]);
    }
}
}
