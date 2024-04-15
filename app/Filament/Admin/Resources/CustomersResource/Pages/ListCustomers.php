<?php

namespace App\Filament\Admin\Resources\CustomersResource\Pages;

use App\Filament\Admin\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
