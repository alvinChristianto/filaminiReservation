<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipePengajuanResource\Pages;
use App\Filament\Resources\TipePengajuanResource\RelationManagers;
use App\Models\TipePengajuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipePengajuanResource extends Resource
{
    protected static ?string $model = TipePengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pengajuan';
    protected static ?string $navigationLabel = 'Tipe Pengajuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_tipe')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_tipe')
                ->searchable(isIndividual: true),
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
            'index' => Pages\ListTipePengajuans::route('/'),
            'create' => Pages\CreateTipePengajuan::route('/create'),
            'edit' => Pages\EditTipePengajuan::route('/{record}/edit'),
        ];
    }
}
