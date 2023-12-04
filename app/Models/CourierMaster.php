<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierMaster extends Model
{
    use HasFactory;

    public function CourierDetail() {
        return $this->hasMany(PatientCourierDetail::class, 'courier_company');
    }
}
