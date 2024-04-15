<?php

namespace App\Filament\Admin\Resources\CustomersResource\Pages;

use App\Filament\Admin\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomers extends EditRecord
{
    protected static string $resource = CustomersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
