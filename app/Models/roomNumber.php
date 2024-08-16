<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomNumber extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'room_number_name',
    //     'description',
    //     // 'room_id',
    //     'status'
    // ];
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // public function roomtype(): HasMany
    // {
    //     return $this->hasMany(RoomType::class);
    // }

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class, 'id_room', 'id');
    }

    public function roomservices(): HasMany
    {
        return $this->hasMany(RoomService::class);
    }
}
