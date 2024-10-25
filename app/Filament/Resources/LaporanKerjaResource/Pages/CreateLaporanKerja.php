<?php

namespace App\Filament\Resources\LaporanKerjaResource\Pages;

use App\Filament\Resources\LaporanKerjaResource;
use App\Models\EngineerItem;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporanKerja extends CreateRecord
{
    protected static string $resource = LaporanKerjaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $tot = 0;
        //repeater have bug on saving, harga akhir will deleted. to prevent this. use this :
        foreach ($data['bahan_engineer'] as &$item) {
            $dataEngineerItem = EngineerItem::where('id', $item["id bahan"])->select('item_name', 'percent_increase', 'base_price')->first();

            $ha = ((100 + $dataEngineerItem->percent_increase) / 100) * $dataEngineerItem->base_price * $item["jumlah"];
            $item["harga dasar"] = $dataEngineerItem->base_price;
            $item["percent"] = $dataEngineerItem->percent_increase;
            $item["harga akhir"] = intval($ha); //casting to int
            $tot = $tot + $item["harga akhir"];

            $item["nama bahan"] = $dataEngineerItem->item_name;
        }

        $dt = json_encode($data['bahan_engineer']);

        $parsed_data = json_decode($dt, true);

        ob_start();

        foreach ($parsed_data as $item) {
            echo "id bahan : " . $item['id bahan'] . "\n";
            echo "nama barang : " . $item['nama bahan'] . "\n";
            echo "jumlah  : " . $item['jumlah'] . "\n";
            echo "harga dasar : " . $item['harga dasar'] . "\n";
            echo "harga akhir : " . $item['harga akhir'] . "\n";
            echo "percent : " . $item['percent'] . "\n\n";
        }

        $data['detail_bahan_engineer']  = ob_get_clean();

        $data['harga_total'] = $tot;

        $data['user_id'] = auth()->id();
        
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
