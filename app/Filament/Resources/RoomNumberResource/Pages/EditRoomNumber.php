<?php

namespace App\Filament\Resources\RoomNumberResource\Pages;

use App\Filament\Resources\RoomNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomNumber extends EditRecord
{
    protected static string $resource = RoomNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
