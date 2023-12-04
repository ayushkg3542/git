<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPersonalDetail extends Model
{
    use HasFactory;

    public function ContactDetail() {
        return $this->hasOne(PatientContactDetail::class, "patient_id");
    }

    public function MedicalDetail() {
        return $this->hasOne(PatientMedicalDetail::class, "patient_id");
    }

    public function DoctorQuestion() {
        return $this->hasMany(PatientDoctorQuestion::class, "patient_id");
    }

    public function Prescription() {
        return $this->hasMany(PatientPrescription::class, "patient_id");
    }

    public function CourierDetail() {
        return $this->hasMany(PatientCourierDetail::class, "patient_id");
    }

    public function PaymentDetail() {
        return $this->hasMany(PatientPaymentDetail::class,"patient_id");
    }

    public function PatientStatus() {
        return $this->belongsTo(PatientStatusMaster::class, 'status_id');
    }

    public function MedicineSaleInvoice() {
        return $this->hasMany(MedicineSaleInvoice::class, 'patient');
    }
}
