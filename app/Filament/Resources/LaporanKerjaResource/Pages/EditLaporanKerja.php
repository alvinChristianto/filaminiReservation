<?php

namespace App\Filament\Resources\LaporanKerjaResource\Pages;

use App\Filament\Resources\LaporanKerjaResource;
use App\Models\EngineerItem;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKerja extends EditRecord
{
    protected static string $resource = LaporanKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        //repeater have bug on saving, harga akhir will deleted. to prevent this. use this :
        foreach ($data['bahan_engineer'] as &$item) {
            $dataEngineerItem = EngineerItem::where('id', $item["id bahan"])->select('item_name', 'percent_increase', 'base_price')->first();
            $ha = ((100 + $dataEngineerItem->percent_increase) / 100) * $dataEngineerItem->base_price * $item["jumlah"];
            $item["harga akhir"] = intval($ha); //casting to int
            $item["nama bahan"] = $dataEngineerItem->item_name;
        }
        $data['detail_bahan_engineer'] = json_encode($data['bahan_engineer']);
        // dd($data);
        return $data;
    }
}
