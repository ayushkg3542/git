<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorQuestionMaster extends Model
{
    use HasFactory;

    public function DoctorQuestion() {
        return $this->hasMany(PatientDoctorQuestion::class, "question_id");
    }
}
