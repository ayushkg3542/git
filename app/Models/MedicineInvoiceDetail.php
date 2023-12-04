<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineInvoiceDetail extends Model
{
    use HasFactory;

    public function Supplier() {
        return $this->belongsTo(MedicineSupplierMaster::class, 'supplier');
    }
}
