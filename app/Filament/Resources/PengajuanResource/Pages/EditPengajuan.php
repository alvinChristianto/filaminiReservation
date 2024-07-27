<?php

namespace App\Filament\Resources\PengajuanResource\Pages;

use App\Filament\Resources\PengajuanResource;
use App\Models\Pengajuan;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EditPengajuan extends EditRecord
{
    protected static string $resource = PengajuanResource::class;
    protected $allowedUserIds = [1];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // Actions\EditAction::make()
            //     ->using(function (Pengajuan $record, array $data): Pengajuan {
            //         $record->update($data);

            //         return $record;
            //     })
            //     ->successNotification(
            //         Notification::make()
            //             ->success()
            //             ->title('User updated')
            //             ->body('The usder has been saved successfully.'),
            //     ),

            Actions\Action::make('Ubah Status')
                ->hidden(fn (Pengajuan $record) => $record->status_pengajuan === 'SELESAI' || !in_array(auth()->id(), $this->allowedUserIds)) // Disable if status is "SELESAI"
                ->form([

                    Forms\Components\Select::make('status_pengajuan')
                        ->options([
                            'DISETUJUI' => 'DISETUJUI',
                            'SELESAI' => 'SELESAI',
                            'DITOLAK' => 'DITOLAK',
                        ]),
                    Forms\Components\FileUpload::make('image_lampiran_approval')
                        ->image()
                        ->directory('pengajuan-attachments')
                        ->deletable(false)
                        ->columnSpan('full'),
                    Forms\Components\Textarea::make('notes_approval')
                        // ->required()
                        ->rows(5)
                        ->cols(5),
                    // ...
                ])
                ->action(function (array $data, Pengajuan $record): void {

                    $record->status_pengajuan = $data['status_pengajuan'];
                    $record->image_lampiran_approval = $data['image_lampiran_approval'];
                    $record->notes_approval = $data['notes_approval'];
                    $record->last_edited_by_id = auth()->id();
                    $record->tanggal_approval = Carbon::now()->setTimezone("Asia/Jakarta");

                    $record->save();
                    Notification::make()
                        ->success()
                        ->title('pengajuan updated')
                        ->body('The pengajuan has been saved successfully to DISETUJUI')
                        ->send();
                }),

            // for user to membelanjakan DISETUJUI pengajuan
            Actions\Action::make('Selesaikan Pengajuan')
                ->hidden(fn (Pengajuan $record) => $record->status_pengajuan !== 'DISETUJUI') // Disable if status is "SELESAI"
                ->form([

                    Forms\Components\FileUpload::make('image_lampiran_pembelanjaan')
                        ->image()
                        ->directory('pengajuan-attachments')
                        ->deletable(false)
                        ->columnSpan('full'),
                    Forms\Components\Textarea::make('notes_pembelanjaan')
                        // ->required()
                        ->rows(5)
                        ->cols(5),
                    // ...
                ])
                ->action(function (array $data, Pengajuan $record): void {

                    $record->status_pengajuan = 'SELESAI';
                    $record->image_lampiran_pembelanjaan = $data['image_lampiran_pembelanjaan'];
                    $record->notes_pembelanjaan = $data['notes_pembelanjaan'];
                    $record->last_edited_by_id = auth()->id();
                    $record->tanggal_pembelanjaan = Carbon::now()->setTimezone("Asia/Jakarta");

                    $record->save();
                    Notification::make()
                        ->success()
                        ->title('pengajuan updated')
                        ->body('The pengajuan has been saved successfully to SELESAI')
                        ->send();
                })

        ];
    }

    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),
            // Actions\EditAction::make()
            //     ->using(function (Pengajuan $record, array $data): Pengajuan {
            //         $record->fill($data);
            //         $record->saveOrFail();
            //         dd($data);
            //         return $record;
            //     })
            //     ->hidden(fn (Pengajuan $record) => $record->status_pengajuan === 'SELESAI' || !in_array(auth()->id(), $this->allowedUserIds))
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['last_edited_by_id'] = auth()->id();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
