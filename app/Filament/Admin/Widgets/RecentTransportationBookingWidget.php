<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use App\Models\Booking;
use Filament\Tables\Table;
use App\Models\SiteSetting;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentTransportationBookingWidget extends BaseWidget
{
  
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4;
   


    public function table(Table $table): Table
    { 
        
        $currency = "";

        $total_debit = $balance = 0;
        
        $sitecurrency = SiteSetting::first()->currency;

        if(!empty($sitecurrency)){
            $currency = $sitecurrency;
        }else{
            $currency = "USD";
        }


        return $table
            ->heading('Recent Transportation Bookings')
            ->query(
                // ...
                Booking::where('type','kitchen')->orderBy('id','desc')
            )
            ->columns([
                //
       


                TextColumn::make('reference_code')
                    ->label('Reference Code')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Reference code copied!')
                    ->toggleable(),


                TextColumn::make('note')
                    ->label('Order Info')
                    ->searchable()
                    ->markdown()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('vat')
                    ->label('VAT')
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),
                    
                TextColumn::make('debit')
                    ->label('Debit')
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),

                
                
                TextColumn::make('total_debit')
                    ->label('Total Debit')
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('credit')
                    ->label('Credit')
                    ->searchable()
                    ->money($currency)
                    ->toggleable(),

                


                TextColumn::make('balance')
                    ->label('Balance')
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),
                
                    TextColumn::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Cancelled' => 'danger',
                            'Active' => 'success',
                            'Completed' => 'info',
                        })

                
            ])
            ->filters([
                //
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ;
    }
}
