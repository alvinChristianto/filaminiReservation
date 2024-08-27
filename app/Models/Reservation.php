<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string'];
    protected $keyType = 'string';

    public function room(): HasMany
    {
        return $this->hasMany(RoomType::class);
    }
    public function roomnumber(): HasMany
    {
        return $this->hasMany(RoomNumber::class);
    }
    public function roomtype(): HasMany
    {
        return $this->hasMany(RoomType::class);
    }
    public function bank(): HasMany
    {
        return $this->hasMany(Bank::class);
    }
}
