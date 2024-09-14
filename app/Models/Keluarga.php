<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keluarga extends Model
{
    use HasFactory;
    
    public function penduduk(): HasMany
    {
        return $this->hasMany(Penduduk::class);
    }
    
}
