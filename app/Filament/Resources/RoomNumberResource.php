<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomNumberResource\Pages;
use App\Filament\Resources\RoomNumberResource\RelationManagers;
use App\Models\RoomNumber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomNumberResource extends Resource
{
    protected static ?string $model = RoomNumber::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Reservasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('room_number_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('id_room')
                    ->relationship('roomtype', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'ACTIVE' => 'ACTIVE',
                        'INACTIVE' => 'INACTIVE',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('room_number_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
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
            'index' => Pages\ListRoomNumbers::route('/'),
            'create' => Pages\CreateRoomNumber::route('/create'),
            'edit' => Pages\EditRoomNumber::route('/{record}/edit'),
        ];
    }
}
