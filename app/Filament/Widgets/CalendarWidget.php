<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\LaporanKerjaResource;
use App\Models\LaporanKerja;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DateTimePicker;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = LaporanKerja::class;

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
        return LaporanKerja::query()
            ->where('jam_mulai', '>=', $fetchInfo['start'])
            ->where('jam_selesai', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(LaporanKerja $event) => [
                    'id' => $event->id,
                    'title' => $event->judul_pekerjaan,
                    'start' => $event->jam_mulai,
                    'end' => $event->jam_selesai,
                    'shouldOpenUrlInNewTab' => true
                ]
            )
            ->all();
    }
}
