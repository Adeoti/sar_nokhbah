<?php

namespace App\Filament\Admin\Resources\HotelsBookingResource\Pages;

use App\Filament\Admin\Resources\HotelsBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotelsBooking extends CreateRecord
{
    protected static string $resource = HotelsBookingResource::class;





    protected function afterCreate(): void
    {
        $this->dispatch(
            'alert',
            title: 'Booking Recorded',
            text: 'You\'ve successfully booked an hotel.',
            type: 'success',
            button: 'Got it'
        );
    }
}
