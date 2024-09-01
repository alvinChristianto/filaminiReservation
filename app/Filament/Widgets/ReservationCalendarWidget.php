<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ReservationResource;
use Saade\FilamentFullCalendar\Actions;
use App\Models\Reservation;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class ReservationCalendarWidget extends FullCalendarWidget
{
    // protected static string $view = 'filament.widgets.reservation-calendar-widget';
    protected static bool $isDiscovered = false; 
    public Model | string | null $model = Reservation::class;

    protected function headerActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridMonth,timeGridWeek,dayGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        // This method should return an array of event-like objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#returning-events
        // You can also return an array of EventData objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#the-eventdata-class

        $result =  Reservation::query()
            ->join('room_types', 'reservations.id_room', '=', 'room_types.id')
            ->where('check_in_time', '>=', $fetchInfo['start'])
            ->where('check_out_time', '<=', $fetchInfo['end'])
            
            ->select('reservations.id', 'reservations.check_in_time', 'reservations.check_out_time', 'room_types.name', 'reservations.first_name', 'reservations.last_name','room_types.color' )
            
            ->get()
            ->map(
                fn (Reservation $event) => [
                    'title' => strval($event->id) . " | " . strval($event->name) . " | ". $event->first_name . " ". $event->last_name,
                    'start' => $event->check_in_time,
                    'end' => $event->check_out_time,
                    'color' => $event->color,
                    'url' => ReservationResource::getUrl(name: 'edit', parameters: ['record' => $event]),
                    'shouldOpenUrlInNewTab' => true
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
