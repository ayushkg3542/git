<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSupplierMaster extends Model
{
    use HasFactory;

    public function MedicineInvoiceDetail() {
        return $this->hasMany(MedicineInvoiceDetail::class,'patient');
    }
}
