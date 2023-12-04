<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{
    use HasFactory;

    public function Medicine() {
        return $this->belongsTo(MedicineMaster::class, 'medicine');
    }
}
