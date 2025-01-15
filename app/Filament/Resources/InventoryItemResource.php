<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryItemResource\Pages;
use App\Filament\Resources\InventoryItemResource\RelationManagers;
use App\Models\Inventory_item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryItemResource extends Resource
{
    protected static ?string $model = Inventory_item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(255)
                    ->rows(3)
                    ->columnSpan('full'),

                Forms\Components\Select::make('unit')
                    ->options([
                        'pieces' => 'pieces',
                        'unit' => 'unit',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric(),
                Forms\Components\Select::make('divisi_id')
                    ->relationship('divisi', 'nama')
                    ->searchable()
                    // ->preload()
                    // ->createOptionForm([
                    //     Forms\Components\TextInput::make('name')
                    //         ->required()
                    //         ->maxLength(255),
                    //     Forms\Components\TextInput::make('email')
                    //         ->label('Email address')
                    //         ->email()
                    //         ->required()
                    //         ->maxLength(255),
                    //     Forms\Components\TextInput::make('phone')
                    //         ->label('Phone number')
                    //         ->tel()
                    //         ->required(),
                    // ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable('desc'),
                Tables\Columns\TextColumn::make('unit'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\InventoryHistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventoryItems::route('/'),
            'create' => Pages\CreateInventoryItem::route('/create'),
            'edit' => Pages\EditInventoryItem::route('/{record}/edit'),
        ];
    }
}
