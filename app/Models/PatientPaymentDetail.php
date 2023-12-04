<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPaymentDetail extends Model
{
    use HasFactory;

    public function PatientDetail() {
        return $this->belongsTo(PatientPersonalDetail::class);
    }
}
