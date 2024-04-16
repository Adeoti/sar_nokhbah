<?php

namespace App\Filament\Exports;

use App\Models\Customer;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;

class CustomerExporter extends Exporter
{
    protected static ?string $model = Customer::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('user.name')
            ->formats([
                ExportFormat::Csv
            ])
            ,
            ExportColumn::make('name')
            ->formats([
                ExportFormat::Csv
            ])
            ,
            ExportColumn::make('email')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
            ExportColumn::make('phone_number')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
            ExportColumn::make('country')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
            ExportColumn::make('address')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
            ExportColumn::make('info')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
            ExportColumn::make('created_at')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
            ExportColumn::make('updated_at')
            ->formats([
                ExportFormat::Csv
            ])
            
            ,
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your customer export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
