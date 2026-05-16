<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProfileAssessmentTestScore extends Model
{
    protected $fillable = [
        'quiz_id',
        'candidate_id',
        'question_bank_id',
        'score',
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
