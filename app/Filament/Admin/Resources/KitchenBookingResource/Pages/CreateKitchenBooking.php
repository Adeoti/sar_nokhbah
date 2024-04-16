<?php

namespace App\Filament\Admin\Resources\KitchenBookingResource\Pages;

use App\Filament\Admin\Resources\KitchenBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKitchenBooking extends CreateRecord
{
    protected static string $resource = KitchenBookingResource::class;



    
    protected function afterCreate(): void
    {
        $this->dispatch(
            'alert',
            title: 'Booking Recorded',
            text: 'You\'ve successfully booked a catering gig.',
            type: 'success',
            button: 'Got it'
        );
    }
}
