<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanKerjaResource\Pages;
use App\Filament\Resources\LaporanKerjaResource\RelationManagers;
use App\Models\LaporanKerja;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class LaporanKerjaResource extends Resource
{
    protected static ?string $model = LaporanKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'Laporan Kerja';
    protected static ?string $navigationLabel = 'Laporan Kerja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Data Pekerjaan')
                    ->schema([
                        Forms\Components\TextInput::make('judul_pekerjaan')
                            ->maxLength(255)
                            ->columnSpan('full'),

                        Forms\Components\Select::make('divisi_id')
                            ->relationship('divisi', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan('full'),

                    ]),
                Fieldset::make('Deskripsi')
                    ->schema([
                        DateTimePicker::make('jam_mulai')
                            ->seconds(false)
                            ->timezone('Asia/Jakarta'),
                        DateTimePicker::make('jam_selesai')
                            ->seconds(false)
                            ->timezone('Asia/Jakarta'),
                        Forms\Components\Textarea::make('deskripsi_masalah')
                            // ->required()
                            ->rows(7)
                            ->columnSpan('full'),
                        Forms\Components\Textarea::make('deskripsi_penyelesaian')
                            // ->required()
                            ->rows(7)
                            ->columnSpan('full')
                    ]),
                Fieldset::make('Lampiran')
                    ->schema([
                        FileUpload::make('image_sebelum_pekerjaan')
                            ->image()
                            ->directory('before-attachments')
                            ->deletable(false)
                            ->openable(),
                        FileUpload::make('image_setelah_pekerjaan')
                            ->image()
                            ->directory('after-attachments')
                            ->deletable(false)
                            ->openable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_pekerjaan')
                    ->limit(15)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('divisi.nama')
                    ->sortable('desc'),

                Tables\Columns\TextColumn::make('jam_mulai'),
                Tables\Columns\TextColumn::make('jam_selesai'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable('desc'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('divisi')
                    ->relationship('divisi', 'nama')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('judul_pekerjaan'),
                            Column::make('divisi.nama'),
                            Column::make('jam_mulai'),
                            Column::make('jam_selesai'),
                            Column::make('deskripsi_masalah'),
                            Column::make('deskripsi_penyelesaian'),
                            Column::make('image_setelah_pekerjaan'),
                        ]),
                    ]),
                ]),
            ])
            ->groups([
                Group::make('divisi.nama')
                    ->orderQueryUsing(fn(Builder $query, string $direction) => $query->orderBy('created_at', 'asc')),
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
            'index' => Pages\ListLaporanKerjas::route('/'),
            'create' => Pages\CreateLaporanKerja::route('/create'),
            'edit' => Pages\EditLaporanKerja::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'view_all_data',
            'create',
            'update',
            'delete',
            'delete_any',
            'view_all_data_laporan_kerja'
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        $userRoles = $user->roles; // Get the user's roles collection

        $hasPermission = false; // Flag to track permission status

        foreach ($userRoles as $role) {
            if ($role->hasPermissionTo('view_all_data_pengajuan')) {
                $hasPermission = true; // Set flag to true if any role has the permission
                break; // Exit the loop once permission is found (optimization)
            }
        }

        if ($hasPermission) {
            return parent::getEloquentQuery();
        } else {
            return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
        }
    }
}
