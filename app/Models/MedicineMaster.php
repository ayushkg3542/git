<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineMaster extends Model
{
    use HasFactory;

    public function MedicinePurchase() {
        return $this->hasMany(MedicinePurchaseDetail::class, 'medicine');
    }

    public function MedicineSale() {
        return $this->hasMany(MedicineSaleDetail::class, 'medicine');
    }

    public function MedicineStock() {
        return $this->hasMany(MedicineStock::class,'medicine');
    }
}
