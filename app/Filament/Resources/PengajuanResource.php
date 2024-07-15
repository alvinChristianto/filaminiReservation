<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanResource\Pages;
use App\Filament\Resources\PengajuanResource\RelationManagers;
use App\Models\Pengajuan;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pengajuan';
    protected static ?string $navigationLabel = 'Master Pengajuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Data Pengaju')
                    ->schema([
                        Forms\Components\TextInput::make('nama_pengaju')
                            ->maxLength(255),

                        Forms\Components\Select::make('divisi_id')
                            ->relationship('divisi', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                    ])
                    ->columns(2),

                Fieldset::make('Data Pengajuan')
                    ->schema([
                        Forms\Components\TextInput::make('judul_pengajuan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('tipe_pengajuan_id')
                            ->label('Pengajuan RAB atau Non RAB')
                            ->relationship('tipe_pengajuan', 'nama_tipe')
                            ->required(),
                        Forms\Components\TextInput::make('nominal')
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(42949672.95),
                        Forms\Components\Textarea::make('notes')
                            // ->required()
                            ->rows(5)
                            ->cols(5),
                    ])
                    ->columns(2),

                Fieldset::make('Data Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('bank_id')
                            ->relationship('bank', 'nama_bank')
                            ->required(),
                        Forms\Components\TextInput::make('nama_pemilik_rekening')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nomor_rekening')
                            ->maxLength(255),
                        DateTimePicker::make('tanggal_akhir_bayar')
                            ->seconds(false),
                    ])
                    ->columns(3),

                Fieldset::make('Lampiran')
                    ->schema([
                        FileUpload::make('image_lampiran_pengajuan')
                            ->image()
                            ->directory('pengajuan-attachments')
                            ->deletable(false)
                            ->columnSpan('full'),
                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_pengajuan')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('status_pengajuan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->options([
                        'DIAJUKAN' => 'DIAJUKAN',
                        'SELESAI' => 'SELESAI',
                        'DITOLAK' => 'DITOLAK',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuans::route('/'),
            'create' => Pages\CreatePengajuan::route('/create'),
            'edit' => Pages\EditPengajuan::route('/{record}/edit'),
        ];
    }
}
