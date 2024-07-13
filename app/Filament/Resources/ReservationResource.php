<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Carbon\Carbon;
use Closure;
use Exception;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Set;
use Filament\Components\Component;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-m-identification';

    protected static ?string $navigationGroup = 'Reservasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('token_reservation')
                //     ->required()
                //     ->maxLength(10),

                Forms\Components\TextInput::make('first_name')
                    // ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    // ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    //->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\Select::make('country')
                    ->options([
                        'Indonesia' => 'Indonesia',
                        'United States' => 'United States',
                        'Germany' => 'Germany',
                    ]),
                //->required(),
                FileUpload::make('image_identity')
                    ->image()
                    ->directory('form-attachments')
                    ->deletable(false)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('address')
                    //->required()
                    ->rows(5)
                    ->cols(10)
                    ->columnSpan('full'),
                DateTimePicker::make('check_in_time')
                    ->seconds(false),
                //->required(),
                DateTimePicker::make('check_out_time')
                    ->seconds(false),
                //->required(),
                Forms\Components\TextInput::make('duration')
                    ->label('Duration (Minutes)') // Add a descriptive label
                    ->disabled()
                    ->dehydrated(false)
                    ->reactive(),

                Forms\Components\Select::make('type_reservation')
                    ->options([
                        'WALKIN' => 'WALKIN',
                        'RESERVATION' => 'RESERVATION',
                        'OTA' => 'OTA',
                    ]),
                // ->required(),
                Forms\Components\Select::make('id_room')
                    ->relationship('room', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('room_count')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                    ]),
                // ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->maxValue(42949672.95),

                // Forms\Components\TextInput::make('cost')
                //     ->numeric()
                //     ->prefix('Rp')
                //     ->suffixAction(
                //         Action::make('copyCostToPrice')
                //             ->icon('heroicon-m-clipboard')
                //             ->requiresConfirmation()
                //             ->action(function (Set $set, $state) {
                //                 $set('price', $state);
                //             })
                //     ),

                Forms\Components\Textarea::make('notes')
                    // ->required()
                    ->rows(5)
                    ->cols(5),

                //setactive and will show another form
                // Forms\Components\Checkbox::make('is_company')
                //     ->live(),

                // Forms\Components\TextInput::make('company_name')
                //     ->visible(fn (Get $get): bool => $get('is_company'))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('payment_status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_reservation')
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_in_time'),
                Tables\Columns\TextColumn::make('check_out_time'),
                Tables\Columns\TextColumn::make('room_count'),
                Tables\Columns\TextColumn::make('price'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_reservation')
                    ->options([
                        'WALKIN' => 'WALKIN',
                        'RESERVATION' => 'RESERVATION',
                        'OTA' => 'OTA',
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'UNPAID' => 'UNPAID',
                        'PAID' => 'PAID',
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
