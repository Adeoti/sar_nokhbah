<?php

namespace App\Filament\Admin\Resources\KitchenBookingResource\Pages;

use App\Filament\Admin\Resources\KitchenBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKitchenBooking extends EditRecord
{
    protected static string $resource = KitchenBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
