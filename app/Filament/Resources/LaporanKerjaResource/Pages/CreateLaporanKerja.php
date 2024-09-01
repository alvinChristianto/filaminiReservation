<?php

namespace App\Filament\Resources\LaporanKerjaResource\Pages;

use App\Filament\Resources\LaporanKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporanKerja extends CreateRecord
{
    protected static string $resource = LaporanKerjaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
