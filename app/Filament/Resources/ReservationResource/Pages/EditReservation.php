<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Actions;
use Filament\Forms;
use App\Models\Reservation;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Select;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            // Actions\Action::make('updateAuthor')
            //     ->form([
            //         Select::make('authorId')
            //             ->label('Author')
            //             ->options(Reservation::query()->pluck('name', 'id'))
            //             ->required(),
            //     ])
            //     ->action(function (array $data, Post $record): void {
            //         $record->author()->associate($data['authorId']);
            //         $record->save();
            //     })
        ];
    }
}
