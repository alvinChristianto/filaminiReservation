<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KeluargaResource\Pages;
use App\Filament\Resources\KeluargaResource\RelationManagers;
use App\Models\Keluarga;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class KeluargaResource extends Resource
{
    protected static ?string $model = Keluarga::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_kk')
                    ->maxLength(100)
                    ->columnSpan('full')
                    ->required(),
                Forms\Components\Select::make('rt')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ])
                    ->required(),
                Forms\Components\Select::make('rw')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('kelurahan')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\TextInput::make('kecamatan')
                    ->maxLength(100)
                    ->required(),
                Forms\Components\TextInput::make('kabupaten')
                    ->maxLength(100)
                    ->required(),
                Forms\Components\TextInput::make('provinsi')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->rows(5)
                    ->cols(5)
                    ->columnSpan('full')
                    ->required(),
                FileUpload::make('image_keluarga')
                    ->image()
                    ->directory('keluarga-attachments')
                    ->deletable(false)
                    ->openable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_kk')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('rt')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('rw')
                    ->searchable(isIndividual: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Pdf')
                    ->icon('heroicon-m-clipboard')
                    ->url(fn (keluarga $record) => route('keluarga.report', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('no_kk'),
                            Column::make('rt'),
                            Column::make('rw'),
                            Column::make('kelurahan'),
                            Column::make('kecamatan'),
                            Column::make('kabupaten'),
                            Column::make('provinsi'),
                            Column::make('address'),
                            Column::make('image_keluarga'),
                        ]),
                    ]),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PenduduksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeluargas::route('/'),
            'create' => Pages\CreateKeluarga::route('/create'),
            'edit' => Pages\EditKeluarga::route('/{record}/edit'),
        ];
    }
}
