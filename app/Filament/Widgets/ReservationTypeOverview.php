<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservationTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Reservation', Reservation::query()->where('type_reservation', 'reservation')->count()),
            // Stat::make('OTAs', Reservation::query()->where('type_reservation', 'ota')->count()),
            // Stat::make('Walkin', Reservation::query()->where('type_reservation', 'walkin')->count()),
        ];
    }
}
