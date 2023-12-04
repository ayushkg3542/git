<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierStatusMaster extends Model
{
    use HasFactory;

    public function CourierDetail() {
        return $this->hasMany(PatientCourierDetail::class, 'status');
    }
}
