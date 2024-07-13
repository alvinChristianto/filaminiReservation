<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'image',
        'description',
        'room_count',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'image' => 'array',
            'attachment_file_names' => 'array'
        ];
    }
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
 
    public function roomservices(): HasMany
    {
        return $this->hasMany(RoomService::class);
    }
}
