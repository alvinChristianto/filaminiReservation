<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Filament\Resources\PendudukResource\RelationManagers;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
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
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('place_birth')
                    ->maxLength(255)
                    ->required(),
                DateTimePicker::make('date_birth')
                    ->seconds(false)
                    ->maxDate(now())
                    ->timezone('Asia/Jakarta')->required(),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_ktp')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('keluarga.no_kk')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('rt')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('rw')
                    ->searchable(isIndividual: true),
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
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('no_ktp'),
                            Column::make('keluarga_id'),
                            Column::make('name'),
                            Column::make('gender'),
                            Column::make('place_birth'),
                            Column::make('date_birth'),
                            Column::make('address1'),
                            Column::make('address2'),
                            Column::make('rt'),
                            Column::make('rw'),
                            Column::make('working_status'),
                            Column::make('marriage_status'),
                            Column::make('image_penduduk'),
                        ]),
                    ]),
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
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}
