<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory_item extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string'];
    protected $keyType = 'string';
    
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }
 
    public function inventory_history(): HasMany
    {
        return $this->hasMany(Inventory_history::class);
    }
}
