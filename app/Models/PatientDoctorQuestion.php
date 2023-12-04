<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDoctorQuestion extends Model
{
    use HasFactory;

    public function PatientDetail() {
        return $this->belongsTo(PatientPersonalDetail::class);
    }

    public function QuestionMaster() {
        return $this->belongsTo(DoctorQuestionMaster::class, "question_id");
    }
}
