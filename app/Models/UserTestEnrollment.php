<?php

namespace App\Models;

use App\Models\CandidateProfileAssessmentScore;
use App\Models\Admin\Users\Candidate;
use App\Models\Coupon;
use App\Models\User\SubmittedTest;
use Illuminate\Database\Eloquent\Model;

class UserTestEnrollment extends Model
{
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function candidateQuiz()
    {
        return $this->hasMany(SubmittedTest::class,'quiz_id','quiz_id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
    public function candidateQuizAttempts()
    {
        return $this->hasMany(SubmittedTest::class, 'quiz_id', 'quiz_id')
                    ->whereColumn('candidate_id', 'user_test_enrollments.candidate_id');
    }
    
    public function getLastSubmittedTestAttribute()
    {
        return SubmittedTest::where('candidate_id', $this->candidate_id)
            ->where('quiz_id', $this->quiz_id)
            ->latest('submitted_at')
            ->first();
    }
    
    public function submittedQuestions()
{
    return $this->hasMany(CandidateProfileAssessmentScore::class, 'quiz_id', 'quiz_id')
                ->whereColumn('candidate_id', 'user_test_enrollments.candidate_id');
}

public function coupon()
{
    return $this->belongsTo(Coupon::class,'coupon_id');
}



}
