<?php

namespace App\Filament\Admin\Resources\TransportationBookingResource\Pages;

use App\Filament\Admin\Resources\TransportationBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransportationBookings extends ListRecords
{
    protected static string $resource = TransportationBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
