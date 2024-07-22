<?php

namespace App\Filament\Resources\PengajuanResource\Pages;

use App\Filament\Resources\PengajuanResource;
use App\Models\Pengajuan;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Livewire\Component;

class EditPengajuan extends EditRecord
{
    protected static string $resource = PengajuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\EditAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('User updated')
                        ->body('The usder has been saved successfully.'),
                ),

            Actions\Action::make('Ubah Status')
                ->form([
                    // Forms\Components\TextInput::make('title')
                    //     ->required()
                    //     ->maxLength(255),
                    Forms\Components\Select::make('status_pengajuan')
                        ->options([
                            'DIAJUKAN' => 'DIAJUKAN',
                            'SELESAI' => 'SELESAI',
                            'DITOLAK' => 'DITOLAK',
                        ])
                    // ...
                ])
                ->action(function (array $data, Pengajuan $record): void {

                    $record->status_pengajuan = $data['status_pengajuan'];
                    $record->save();
                    Notification::make()
                        ->success()
                        ->title('User updated')
                        ->body('The user has been saved successfully.')
                        ->send();
                })

        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['nama_pemilik_rekening'] = auth()->id();

        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeSave(): void
    {
        Notification::make()
            ->warning()
            ->title('You don\'t have an active subscription!')
            ->body('Choose a plan to continue.')
            ->persistent()
            ->actions([
                Actions\Action::make('subscribe')
                    ->button()
                    ->url(route('subscribe'), shouldOpenInNewTab: true),
            ])
            ->send();

        $this->halt();
    }
}
