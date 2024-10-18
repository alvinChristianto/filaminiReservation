<?php

namespace App\Filament\Resources\EngineerItemResource\Pages;

use App\Filament\Resources\EngineerItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEngineerItem extends EditRecord
{
    protected static string $resource = EngineerItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
