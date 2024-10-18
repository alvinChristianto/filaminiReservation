<?php

namespace App\Filament\Resources\EngineerItemResource\Pages;

use App\Filament\Resources\EngineerItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEngineerItems extends ListRecords
{
    protected static string $resource = EngineerItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
