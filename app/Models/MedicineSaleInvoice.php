<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSaleInvoice extends Model
{
    use HasFactory;

    public function Patient() {
        return $this->belongsTo(PatientPersonalDetail::class, 'patient');
    }
}
