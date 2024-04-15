<?php

namespace App\Filament\Admin\Resources\ExpensesResource\Pages;

use App\Filament\Admin\Resources\ExpensesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExpenses extends EditRecord
{
    protected static string $resource = ExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
