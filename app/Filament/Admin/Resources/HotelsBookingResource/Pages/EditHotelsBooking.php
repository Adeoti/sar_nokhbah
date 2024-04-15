<?php

namespace App\Filament\Admin\Resources\HotelsBookingResource\Pages;

use App\Filament\Admin\Resources\HotelsBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelsBooking extends EditRecord
{
    protected static string $resource = HotelsBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
