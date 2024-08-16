<?php

namespace App\Filament\Resources\RoomNumberResource\Pages;

use App\Filament\Resources\RoomNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomNumbers extends ListRecords
{
    protected static string $resource = RoomNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
