<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use App\Models\Booking;
use Filament\Tables\Table;
use App\Models\SiteSetting;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentHotelBookingWidget extends BaseWidget
{


    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
   

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
            ->heading(__('messages.RecentHotelBookings'))
            ->query(
                // ...
                Booking::where('type','hotel')->orderBy('id','desc')
            )
            ->columns([
                //
       


                TextColumn::make('reference_code')
                    ->label(__('messages.ReferenceCode'))
                    ->searchable()
                    ->copyable()
                    ->copyMessage(__('messages.ReferenceCodeCopied'))
                    ->toggleable(),


                TextColumn::make('hotel.name')
                    ->label(__('messages.HotelName'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('customer.name')
                    ->label(__('messages.Customer'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('vat')
                    ->label(__('messages.VAT'))
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),
                    
                TextColumn::make('debit')
                    ->label(__('messages.Debit'))
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),

                
                
                TextColumn::make('total_debit')
                    ->label(__('messages.TotalDebit'))
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('credit')
                    ->label(__('messages.Credit'))
                    ->searchable()
                    ->money($currency)
                    ->toggleable(),

                


                TextColumn::make('balance')
                    ->label(__('messages.Balance'))
                    ->money($currency)
                    ->searchable()
                    ->toggleable(),
                
                    TextColumn::make('status')
                        ->badge()
                        ->label(__('messages.Status'))
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
