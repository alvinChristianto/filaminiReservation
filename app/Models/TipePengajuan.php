<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipePengajuan extends Model
{
    use HasFactory;
    
    public function pengajuan(): HasMany
    {
        return $this->hasMany(Pengajuan::class);
    }
}
