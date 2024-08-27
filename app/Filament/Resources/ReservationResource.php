<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Closure;
use Exception;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
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
use Illuminate\Support\Facades\Log;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-m-identification';

    protected static ?string $navigationGroup = 'Reservasi';

    protected static ?string $navigationLabel = 'Reservasi';
    protected static ?string $slug = 'reservasi';


    public static function form(Form $form): Form
    {
        function calculateDuration($checkInTime, $checkOutTime)
        {
            // Ensure input values are Carbon instances
            $checkInTime = Carbon::parse($checkInTime);
            $checkOutTime = Carbon::parse($checkOutTime);

            Log::info($checkInTime);
            Log::info($checkOutTime);

            // Calculate the difference in hours
            $durationHours = $checkInTime->diffInHours($checkOutTime);

            Log::info($durationHours);
            return round($durationHours, 0);
        }

        function calculateCheckOut($checkInTime, $durations)
        {
            // Ensure input values are Carbon instances
            $checkInTime = Carbon::parse($checkInTime);
            $durationInterval = CarbonInterval::hours($durations);

            Log::info($checkInTime);
            Log::info($durations);
            Log::info("here");


            // Calculate the difference in hours
            $checkOutTime = $checkInTime->addHours(intval($durations));

            Log::info($checkOutTime);
            return $checkOutTime;
        }


        return $form
            ->schema([
                // Forms\Components\TextInput::make('token_reservation')
                //     ->required()
                //     ->maxLength(10),

                Forms\Components\Select::make('type_reservation')
                    ->options([
                        'WALKIN' => 'WALKIN',
                        'RESERVATION' => 'RESERVATION',
                        'OTA' => 'OTA',
                    ])
                    ->columnSpan('full'),
                Fieldset::make('Data Tamu')
                    ->schema([
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
                            ->rows(2)
                            ->cols(10)
                            ->columnSpan('full')
                    ]),
                // ---------------------------------

                Fieldset::make('Check in & check out')
                    ->schema([
                        Forms\Components\Toggle::make('is_hour_reservation')
                            ->label('reservasi dengan durasi ')
                            ->columnSpan('full')
                            ->reactive()
                            ->requiredWith('check_out_time', 'duration')
                            ->afterStateUpdated(
                                fn($state, callable $set) => $state ? $set('check_in_time', null) : $set('check_in_time', 'hidden')
                            ),
                        DateTimePicker::make('check_in_time')
                            ->seconds(false)
                            ->timezone('Asia/Jakarta'),
                        //->required(),
                        DateTimePicker::make('check_out_time')
                            ->seconds(false)
                            ->requiredWith('is_hour_reservation')
                            ->disabled(
                                fn($get): bool => $get('is_hour_reservation') == true
                            )
                            ->timezone('Asia/Jakarta')
                            ->dehydrated(false)
                            ->reactive()
                            ->suffixAction(
                                Action::make('copyCostToPrice')
                                    ->icon('heroicon-m-calculator')
                                    ->action(function (Set $set, Get $get, $state) {
                                        $inTime = Carbon::parse($get('check_in_time'));
                                        $outTime = Carbon::parse($state);

                                        Log::info($inTime);
                                        Log::info($outTime);
                                        $durationHours =  calculateDuration($inTime, $outTime);

                                        $set('durations', $durationHours);
                                    })
                            ),
                        //->required(),
                        Forms\Components\TextInput::make('durations')
                            ->label('Duration (Hour)') // Add a descriptive label
                            ->requiredWith('is_hour_reservation')
                            ->disabled(
                                fn($get): bool => $get('is_hour_reservation') == false
                            )
                            ->dehydrated(false)
                            ->reactive()
                            ->suffixAction(
                                Action::make('copyCostToPrice')
                                    ->icon('heroicon-m-calculator')
                                    ->action(function (Set $set, Get $get, $state) {
                                        $inTime = Carbon::parse($get('check_in_time'));
                                        $durations = $state;

                                        Log::info($inTime);
                                        Log::info($durations);
                                        $outTime =  calculateCheckOut($inTime, $durations);
                                        $formattedOut = $outTime->format('Y-m-d H:i');       //need to chhange this line if use seconds
                                        Log::info("---------");
                                        Log::info($outTime);
                                        $set('check_out_time', $formattedOut);
                                    })
                            ),
                    ]),


                // -------------------------------------------------



                // ->required(),

                Fieldset::make('Data Kamar')
                    ->schema([
                        Forms\Components\Select::make('id_room')
                            ->relationship('roomtype', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('room_count')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ]),
                        // ->required(),
                        Forms\Components\TextInput::make('price_per_room')
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(42949672.95)
                            ->reactive()
                            ->suffixAction(
                                Action::make('copyCostToPrice')
                                    ->icon('heroicon-m-calculator')
                                    ->action(function (Set $set, Get $get, $state) {
                                        $count = $get('room_count');
                                        $initPrice = $state;

                                        $tot =  $initPrice * $count;
                                        $set('price_total', $tot);
                                    })
                            ),

                        Forms\Components\Textarea::make('notes')
                            // ->required()
                            ->rows(5)
                            ->cols(5),
                    ]),

                Fieldset::make('Data Pembayaran')
                    ->schema([

                        Forms\Components\TextInput::make('price_total')
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(42949672.95)
                            ,

                        Forms\Components\Select::make('id_bank')
                            ->relationship('bank', 'nama_bank')
                            ->required(),
                        Forms\Components\TextInput::make('owner_rekening')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rekening_number')
                            ->maxLength(255),


                    ]),
                //setactive and will show another form
                // Forms\Components\Checkbox::make('is_company')
                //     ->live(),

                // Forms\Components\TextInput::make('company_name')
                //     ->visible(fn (Get $get): bool => $get('is_company'))

                // Forms\Components\Field::make('start_date'),
                // Forms\Components\Field::make('end_date')->afterOrEqual('start_date')
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
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
