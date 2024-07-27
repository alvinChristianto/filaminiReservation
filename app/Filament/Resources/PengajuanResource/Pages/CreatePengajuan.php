<?php

namespace App\Filament\Resources\PengajuanResource\Pages;

use App\Filament\Resources\PengajuanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePengajuan extends CreateRecord
{
    protected static string $resource = PengajuanResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = auth()->id(); // Add user_id to the data array

        $record = static::getModel()::create($data);
        return $record;
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['last_edited_by_id'] = auth()->id();

        return $data;
    }
}
