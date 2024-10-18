<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EngineerItem extends Model
{
    use HasFactory;
    
    public function laporanKerja(): HasMany
    {
        return $this->hasMany(laporanKerja::class);
    }
}
