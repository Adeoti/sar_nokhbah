<?php

namespace App\Filament\Admin\Resources\TransportationBookingResource\Pages;

use App\Filament\Admin\Resources\TransportationBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportationBooking extends EditRecord
{
    protected static string $resource = TransportationBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
