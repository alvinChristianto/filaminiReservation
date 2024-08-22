<?php

namespace App\Filament\Resources\LaporanKerjaResource\Pages;

use App\Filament\Resources\LaporanKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanKerjas extends ListRecords
{
    protected static string $resource = LaporanKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
