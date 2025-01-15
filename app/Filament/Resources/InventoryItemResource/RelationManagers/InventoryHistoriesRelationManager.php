<?php

namespace App\Filament\Resources\InventoryItemResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'inventory_history';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('adjustment_type')
                    ->options([
                        'baru' => 'baru',
                        'bekas_layak' => 'bekas layak',
                        'bekas_rusak' => 'bekas rusak',
                        'rusak' => 'rusak',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->required()
                    ->maxLength(255)
                    ->rows(3)
                    ->columnSpan('full'),


                Forms\Components\TextInput::make('previous_qty')
                    ->numeric(),

                Forms\Components\TextInput::make('current_qty')
                    ->numeric(),

                Forms\Components\TextInput::make('adjusted_by')
                    ->required()
                    ->maxLength(100),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('reason')
            ->columns([
                Tables\Columns\TextColumn::make('adjustment_type'),
                Tables\Columns\TextColumn::make('reason'),
                Tables\Columns\TextColumn::make('adjusted_by'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
