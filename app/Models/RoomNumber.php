<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number_name',
        'description',
        'status'
    ];
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
 
    public function roomservices(): HasMany
    {
        return $this->hasMany(RoomService::class);
    }
}
