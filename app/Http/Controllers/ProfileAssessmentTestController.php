<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfileAssessmentTestScore;
use App\Models\QuestionBank;
use App\Models\CandidateProfileAssessmentScore;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileAssessmentTestController extends Controller
{
    public function ProfileAssessmentTest()
    {
        try {
            // 👇 Load the very first question for this quiz
            $question = QuestionBank::with('category')
                ->orderBy('id', 'asc')
                ->first();

            if ($question) {
                return view('attemptProfileAssessmentTest')->with([
                    'question' => $question,
                    'totalQuestionsAnswered' => 1
                ]);
            } else {
                Session::flash('error', 'No Question Found...');
                return redirect()->back();
            }
        } catch (\Exception $exception) {
        return back()->withErrors(['error' => 'Unable to load assessment questions.']);
    }

    }
    /**
     * Fetch the next question based on the current question ID.
     */
    public function fetchNextQuestion(Request $request)
    {
        try {
            $questionId = $request->input('currentQuestion');
            $score = $request->input('satisfactionScore');
            $candidate_id = Auth::guard('candidate')->check() ? Auth::guard('candidate')->id() : null;
            $quizId = $request->input('quiz_id');
            // Save current question response
            if ($questionId == 585 and Auth::guard('candidate')->check()) {
                $quizId = $this->createPaymentWithDB($candidate_id)['quiz_id'];
            }
            if(Auth::guard('candidate')->check())
            {
                CandidateProfileAssessmentTestScore::create([
                'quiz_id'          => $quizId,
                'candidate_id'     => $candidate_id,
                'question_bank_id' => $questionId,
                'score'            => $score,
                ]);
            }

            // Fetch next question (simple and efficient)
            $nextQuestion = QuestionBank::with('category')
                ->where('id', '>', $questionId)
                ->orderBy('id')
                ->first();

            if ($nextQuestion) {
                return response()->json([
                    'success' => true,
                    'quizId'  => $quizId,
                    'question' => $nextQuestion
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No more questions available'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function submitTest(Request $request)
    {
        try {
            $candidate = Auth::user();

            if (empty($request->assessment_responses)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No assessment data found.'
                ], 400);
            }

            DB::beginTransaction();

            // Create test record
            $payment = $this->createPaymentWithDB($candidate->id);

            // Store answers
            $this->storeAssessmentResponses(
                $payment['candidate_id'],
                $payment['quiz_id'],
                $request->assessment_responses
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'test_id' => $payment['quiz_id'] // 👈 THIS IS IMPORTANT
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function createPaymentWithDB($candidateId)
    {
        $lastQuizId = DB::table('profile_assessment_tests')
            ->where('candidate_id', $candidateId)
            ->max('quiz_id');

        if ($lastQuizId) {
            // PAT_5 → 5
            $lastNumber = (int) str_replace('PAT_', '', $lastQuizId);
            $quizId = 'PAT_' . ($lastNumber + 1);
        } else {
            $quizId = 'PAT_1';
        }


        $paymentId = DB::table('profile_assessment_tests')->insertGetId([
            'candidate_id'    => $candidateId,
            'quiz_id'         => $quizId,
            'payment_amount'  => $this->testFee(),
            'payment_status'  => 'unpaid',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return [
            'candidate_id' => $candidateId,
            'quiz_id'    => $paymentId,
        ];
    }
    function storeAssessmentResponses($candidateId, $quizId, string $assessmentResponses)
    {
        // Decode JSON string
        $responses = json_decode($assessmentResponses, true);

        if (!is_array($responses)) {
            throw new \Exception('Invalid assessment_responses format');
        }
        foreach ($responses as $item) {
            $questionId = (int) $item['question_bank_id'];
            $score      = (int) $item['score'];

            CandidateProfileAssessmentTestScore::create([
                'quiz_id'          => $quizId,
                'candidate_id'     => $candidateId,
                'question_bank_id' => $questionId,
                'score'            => $score,
            ]);
        }
    }
}
