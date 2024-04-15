<?php

namespace App\Filament\Admin\Resources\HotelsResource\Pages;

use App\Filament\Admin\Resources\HotelsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotels extends ListRecords
{
    protected static string $resource = HotelsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
