<?php

namespace App\Filament\Resources\LaporanKerjaResource\Pages;

use App\Filament\Resources\LaporanKerjaResource;
use App\Filament\Widgets\CalendarWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListLaporanKerjas extends ListRecords
{
    protected static string $resource = LaporanKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()->exports([
                ExcelExport::make('table')->fromTable(),
                ExcelExport::make('form')->fromForm(),
            ]),
            // ExportAction::make() 
            // ->exports([
            //     ExcelExport::make()
            //         ->fromTable()
            //         ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
            //         ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
            //         ->withColumns([
            //             Column::make('updated_at'),
            //         ])
            // ]), 
        ];
    }
    
    protected function getFooterWidgets(): array
    {
        return [
            CalendarWidget::class,
            
        ];
    }
}
