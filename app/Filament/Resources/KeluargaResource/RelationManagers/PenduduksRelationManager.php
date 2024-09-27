<?php

namespace App\Filament\Resources\KeluargaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenduduksRelationManager extends RelationManager
{
    protected static string $relationship = 'penduduk';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_ktp')
                    ->maxLength(100)
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('place_birth')
                    ->maxLength(255),
                DateTimePicker::make('date_birth')
                    ->seconds(false)
                    ->maxDate(now())
                    ->timezone('Asia/Jakarta'),

                Forms\Components\Textarea::make('address1')
                    ->rows(5)
                    ->cols(5)
                    ->required(),

                Forms\Components\Textarea::make('address2')
                    ->rows(5)
                    ->cols(5),
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
                Forms\Components\Select::make('working_status')
                    ->options([
                        'Belum Bekerja' => 'Belum Bekerja',
                        'Petani' => 'Petani',
                        'Wirausaha' => 'Wirausaha',
                        'Sekolah' => 'Sekolah',
                        'Mahasiswa' => 'Mahasiswa',
                        'Pegawai Negeri' => 'Pegawai Negeri',
                        'Pegawai Swasta' => 'Pegawai Swasta',
                        'Pensiunan' => 'Pensiunan',
                    ])
                    ->required(),
                Forms\Components\Select::make('marriage_status')
                    ->options([
                        'Lajang' => 'Lajang',
                        'Menikah' => 'Menikah',
                        'Cerai Mati' => 'Cerai Mati',
                        'Cerai Hidup' => 'Cerai Hidup',
                        'Belum Diketahui' => 'Belum Diketahui'
                    ])
                    ->required(),
                FileUpload::make('image_penduduk')
                    ->image()
                    ->directory('penduduk-attachments')
                    ->deletable(false)
                    ->openable(),
                Forms\Components\Textarea::make('notes')
                    ->rows(5)
                    ->cols(5),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('no_ktp')
            ->columns([
                Tables\Columns\TextColumn::make('no_ktp'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
