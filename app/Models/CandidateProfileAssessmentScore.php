<?php

namespace App\Models;

use App\Models\QuestionBank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CandidateProfileAssessmentScore extends Model
{
        protected $fillable = [
        'question_bank_id',
        'score',
        'candidate_id',
        'quiz_id'
    ];
    public function question()
    {
        return $this->belongsTo(QuestionBank::class, 'question_bank_id');
    }
    
    public function quiz()
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
}
