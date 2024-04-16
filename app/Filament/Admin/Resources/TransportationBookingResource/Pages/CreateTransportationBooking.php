<?php

namespace App\Filament\Admin\Resources\TransportationBookingResource\Pages;

use App\Filament\Admin\Resources\TransportationBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransportationBooking extends CreateRecord
{
    protected static string $resource = TransportationBookingResource::class;



    
    protected function afterCreate(): void
    {
        $this->dispatch(
            'alert',
            title: 'Booking Recorded',
            text: 'You\'ve successfully booked a tour.',
            type: 'success',
            button: 'Got it'
        );
    }

    
}
