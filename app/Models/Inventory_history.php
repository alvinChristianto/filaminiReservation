<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory_history extends Model
{
    use HasFactory;
    
    public function inventory_item(): BelongsTo
    {
        return $this->belongsTo(Inventory_item::class);
    }
}

