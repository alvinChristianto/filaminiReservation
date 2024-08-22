<?php

namespace App\Filament\Resources\LaporanKerjaResource\Pages;

use App\Filament\Resources\LaporanKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKerja extends EditRecord
{
    protected static string $resource = LaporanKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
