<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCourierDetail extends Model
{
    use HasFactory;

    public function PatientDetail() {
        return $this->belongsTo(PatientPersonalDetail::class);
    }

    public function CourierMaster() {
        return $this->belongsTo(CourierMaster::class, 'courier_company');
    }

    public function CourierStatus() {
        return $this->belongsTo(CourierStatusMaster::class, 'status');
    }
}
