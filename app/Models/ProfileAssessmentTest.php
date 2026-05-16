<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileAssessmentTest extends Model
{
    public function paymentTransaction()
    {
        return $this->hasOne(PaymentTransaction::class, 'quiz_id', 'id');
    }

    public function scores()
    {
        return $this->hasMany(CandidateProfileAssessmentTestScore::class, 'quiz_id', 'id');
    }
}
