<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientStatusMaster extends Model
{
    use HasFactory;

    // StatusMaste.php
    public function PatientDetail() {
        return $this->hasMany(PatientPersonalDetail::class, 'status_id');
    }

}
