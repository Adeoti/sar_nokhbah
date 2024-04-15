<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransportationBookingResource\Pages;
use App\Filament\Admin\Resources\TransportationBookingResource\RelationManagers;
use App\Models\TransportationBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransportationBookingResource extends Resource
{
    protected static ?string $model = TransportationBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Booking";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransportationBookings::route('/'),
            'create' => Pages\CreateTransportationBooking::route('/create'),
            'edit' => Pages\EditTransportationBooking::route('/{record}/edit'),
        ];
    }
}
