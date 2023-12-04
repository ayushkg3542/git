<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerGroupMaster extends Model
{
    use HasFactory;

    public function SubGroup() {
        return $this->hasMany(LedgerSubGroupMaster::class, "group_id");
    }
}
