<?php

namespace App\Filament\Resources\TipePengajuanResource\Pages;

use App\Filament\Resources\TipePengajuanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipePengajuan extends EditRecord
{
    protected static string $resource = TipePengajuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
