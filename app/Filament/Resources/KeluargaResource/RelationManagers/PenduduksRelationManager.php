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
                    ->required(),
                Forms\Components\Select::make('keluarga_id')
                    ->relationship('keluarga', 'no_kk')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('gender')
                    ->label('Jenis Kelamin ')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('place_birth')
                    ->label('Tempat Lahir ')
                    ->maxLength(255)
                    ->required(),
                DateTimePicker::make('date_birth')
                    ->label('Tanggal Lahir ')
                    ->seconds(false)
                    ->maxDate(now())
                    ->timezone('Asia/Jakarta')->required(),

                Forms\Components\Textarea::make('address1')
                    ->label('Alamat ke-1 ')
                    ->rows(5)
                    ->cols(5)
                    ->required(),

                Forms\Components\Textarea::make('address2')
                    ->label('Alamat ke-2')
                    ->rows(5)
                    ->cols(5),
                Forms\Components\Select::make('rt')
                    ->label('RT')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ])
                    ->required(),
                Forms\Components\Select::make('rw')
                    ->label('RW')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                    ])
                    ->required(),
                Forms\Components\Select::make('working_status')
                    ->label('status pekerjaan')
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
                    ->label('status pernikahan')
                    ->options([
                        'Lajang' => 'Lajang',
                        'Menikah' => 'Menikah',
                        'Cerai Mati' => 'Cerai Mati',
                        'Cerai Hidup' => 'Cerai Hidup',
                        'Belum Diketahui' => 'Belum Diketahui'
                    ])
                    ->required(),
                FileUpload::make('image_wajah')
                    ->image()
                    ->directory('penduduk-attachments')
                    ->deletable(false)
                    ->openable(),
                FileUpload::make('image_kartu_identitas')
                    ->image()
                    ->directory('kartuidentitas-attachments')
                    ->deletable(false)
                    ->openable(),
                FileUpload::make('image_akta_kelahiran')
                    ->image()
                    ->directory('aktalahir-attachments')
                    ->deletable(false)
                    ->openable(),

                FileUpload::make('image_ijasah')
                    ->image()
                    ->directory('ijasah-attachments')
                    ->deletable(false)
                    ->openable(),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan untuk penduduk')
                    ->rows(5)
                    ->cols(5)
                    ->columnSpan('full'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('no_ktp')
            ->columns([
                Tables\Columns\TextColumn::make('no_ktp'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('place_birth'),
                Tables\Columns\TextColumn::make('date_birth'),
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
