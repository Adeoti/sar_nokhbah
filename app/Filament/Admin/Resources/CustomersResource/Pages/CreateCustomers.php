<?php

namespace App\Filament\Admin\Resources\CustomersResource\Pages;

use App\Filament\Admin\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomers extends CreateRecord
{
    protected static string $resource = CustomersResource::class;
}
