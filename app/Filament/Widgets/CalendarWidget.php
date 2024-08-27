<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\LaporanKerjaResource;
use App\Models\Divisi;
use App\Models\LaporanKerja;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DateTimePicker;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = LaporanKerja::class;

    // protected function headerActions(): array
    // {
    //     return [
    //         CreateAction::make(),
    //     ];
    // }

    // protected function modalActions(): array
    // {
    //     return [
    //         // EditAction::make(),
    //         // DeleteAction::make(),
    //     ];
    // }

    // protected function viewAction(): Action
    // {
    //     return ViewAction::make();
    // }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('judul_pekerjaan'),

            Grid::make()
                ->schema([
                    DateTimePicker::make('jam_mulai'),

                    DateTimePicker::make('jam_selesai'),
                ]),
        ];
    }

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'timeGridWeek, dayGridMonth, dayGridWeek,dayGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }
    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        // This method should return an array of event-like objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#returning-events
        // You can also return an array of EventData objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#the-eventdata-class

        $result =  LaporanKerja::query()
            ->join('divisis', 'laporan_kerjas.divisi_id', '=', 'divisis.id')
            // ->where('divisi_id', '1')
            ->where('jam_mulai', '>=', $fetchInfo['start'])
            ->where('jam_selesai', '<=', $fetchInfo['end'])
            ->select('laporan_kerjas.id', 'laporan_kerjas.jam_mulai', 'laporan_kerjas.jam_selesai', 'laporan_kerjas.divisi_id','divisis.nama','divisis.color', 'laporan_kerjas.judul_pekerjaan')
            ->get()
            ->map(
                fn(LaporanKerja $event) => [
                    'id' => $event->id,
                    'title' => strval($event->divisi_id) . " | " . $event->judul_pekerjaan,
                    'start' => $event->jam_mulai,
                    'end' => $event->jam_selesai,
                    'color' => $event->color,
                    'textColor' => '#020617',
                    'borderColor' => '#020617',
                    'shouldOpenUrlInNewTab' => true,
                    'url' => LaporanKerjaResource::getUrl(name: 'edit', parameters: ['record' => $event]),
                    // 'url' => $event->id
                ]
            )
            ->all();
        return $result;
    }

    public function eventDidMount(): string
    {
        return <<<JS
        function({ event, timeText, isStart, isEnd, isMirror, isPast, isFuture, isToday, el, view }){
            el.setAttribute("x-tooltip", "tooltip");
            el.setAttribute("x-data", "{ tooltip: '"+event.title+"' }");
        }
    JS;
    }
}
