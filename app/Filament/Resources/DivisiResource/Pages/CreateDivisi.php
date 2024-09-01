<?php

namespace App\Filament\Resources\DivisiResource\Pages;

use App\Filament\Resources\DivisiResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDivisi extends CreateRecord
{
    protected static string $resource = DivisiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //automaticaly create role when create divisi
        $createRole = Role::create([
            'name' => $data['nama'],
            'guard_name' => 'web',
        ]);

        $data['role_id'] = $createRole->id;

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
