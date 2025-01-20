<?php

namespace App\Filament\Resources\InventoryItemResource\Pages;

use App\Filament\Resources\InventoryItemResource;
use App\Models\Inventory_history;
use App\Models\Inventory_item;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateInventoryItem extends CreateRecord
{
    protected static string $resource = InventoryItemResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $now = Carbon::now();

        $year = $now->format('y'); // Use 'y' for two-digit year representation
        $month = $now->format('m'); // Use 'm' for zero-padded month number
        $day = $now->format('d'); // Use 'm' for zero-padded month number

        $hour = $now->format('H'); // 24-hour format
        $minute = $now->format('i');
        $second = $now->format('s');


        //get last data of each day
        $transformId = "ASET" . "_" . $data['divisi_id'] . "_" . $day . $month . $year . $hour . $minute . $second;
        $data['id'] = $transformId;

        // $products = Inventory_item::where('id', 'like', $transformId . "%")
        //     ->pluck('id')
        //     ->all();

        // if (empty($products)) {
        //     $newTransformId = $transformId . "1";
        // } else {

        //     $lastThreeDigits = [];

        //     foreach ($products as $value) {
        //         $lastThreeDigits[] = (int) substr($value, -3);
        //     }


        //     $maxValue = max($lastThreeDigits);
        //     $newTransformId = $transformId . intval($maxValue) + 1;
        // }

        // $data['id'] = $newTransformId;
        // dd(auth()->name);
        // dd(Auth::user()->name);

        $itemFirstHistory = Inventory_history::create([
            'inventory_item_id' => $data['id'],
            'adjustment_type' => $data['status_now'],
            'reason' => $data['description'],
            'previous_qty' => 0,
            'current_qty' => $data['quantity'],
            'adjusted_by' => Auth::user()->name,
        ]);

        $itemFirstHistory->save();
        unset($data['status_now']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
