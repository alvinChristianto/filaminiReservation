<?php
namespace App\Filament\Resources\ReservationResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ReservationResource;
use Illuminate\Routing\Router;


class ReservationApiService extends ApiService
{
    protected static string | null $resource = ReservationResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
