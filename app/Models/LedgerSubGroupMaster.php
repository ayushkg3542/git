<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerSubGroupMaster extends Model
{
    use HasFactory;

    public function Group() {
        return $this->belongsTo(LedgerGroupMaster::class);
    }
}
