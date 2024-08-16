<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Filament\Resources\RoomTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRoomTypes extends CreateRecord
{
    protected static string $resource = RoomTypesResource::class;
}
