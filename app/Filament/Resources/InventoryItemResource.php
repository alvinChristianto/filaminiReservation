<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryItemResource\Pages;
use App\Filament\Resources\InventoryItemResource\RelationManagers;
use App\Models\Inventory_item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryItemResource extends Resource
{
    protected static ?string $model = Inventory_item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Inventaris';

    protected static ?string $navigationLabel = 'Data inventaris';
    protected static ?string $slug = 'invetaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(200),
                Forms\Components\Select::make('divisi_id')
                    ->label('cabang/divisi terkait')
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

                Forms\Components\Select::make('unit')
                    ->options([
                        'pieces' => 'pieces',
                        'unit' => 'unit',
                        'buah' => 'buah',
                        'set' => 'set',
                        'potong' => 'potong',
                        'meter' => 'meter',
                        'kg' => 'kg',
                        'gram' => 'gram',
                        'roll' => 'roll',
                        'liter' => 'liter',
                        'galon' => 'galon',
                        'ekor' => 'ekor',
                        'kubik' => 'kubik',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah barang awal')
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->maxValue(42949672.95),


                Forms\Components\DateTimePicker::make('buying_date')
                    ->seconds(false)
                    ->timezone('Asia/Jakarta')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi barang')
                    ->required()
                    ->maxLength(255)
                    ->rows(3)
                    ->columnSpan('full'),
                Forms\Components\Select::make('status_now')
                    ->label('status barang')
                    ->options([
                        'baru' => 'baru',
                        'bekas_layak' => 'bekas layak',
                        'bekas_rusak' => 'bekas rusak',
                        'rusak' => 'rusak',
                    ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('id aset')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Barang')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('divisi.nama')
                    ->label('cabang')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('jumlah awal')
                    ->sortable('desc'),
                Tables\Columns\TextColumn::make('unit'),
                Tables\Columns\TextColumn::make('buying_date')
                    ->label('waktu beli')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('waktu record')->sortable(),
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
                Tables\Actions\BulkActionGroup::make([]),
            ])
            ->groups([
                Group::make('divisi.nama')
                    ->orderQueryUsing(fn (Builder $query, string $direction) => $query->orderBy('created_at', 'asc')),
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
