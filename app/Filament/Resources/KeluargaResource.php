<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KeluargaResource\Pages;
use App\Filament\Resources\KeluargaResource\RelationManagers;
use App\Models\Keluarga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->columnSpan('full'),
                Forms\Components\Select::make('id_head')
                    ->relationship('Penduduk', 'name')
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
                    ->maxLength(100),

                Forms\Components\TextInput::make('kecamatan')
                    ->maxLength(100),
                Forms\Components\TextInput::make('kabupaten')
                    ->maxLength(100),
                Forms\Components\TextInput::make('provinsi')
                    ->maxLength(100),

                Forms\Components\Textarea::make('address')
                    ->rows(5)
                    ->cols(5)
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListKeluargas::route('/'),
            'create' => Pages\CreateKeluarga::route('/create'),
            'edit' => Pages\EditKeluarga::route('/{record}/edit'),
        ];
    }
}
