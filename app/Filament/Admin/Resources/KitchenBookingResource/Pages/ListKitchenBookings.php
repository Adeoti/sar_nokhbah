<?php

namespace App\Filament\Admin\Resources\KitchenBookingResource\Pages;

use App\Filament\Admin\Resources\KitchenBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKitchenBookings extends ListRecords
{
    protected static string $resource = KitchenBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
