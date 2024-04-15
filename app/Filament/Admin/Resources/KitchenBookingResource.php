<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KitchenBookingResource\Pages;
use App\Filament\Admin\Resources\KitchenBookingResource\RelationManagers;
use App\Models\KitchenBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KitchenBookingResource extends Resource
{
    protected static ?string $model = KitchenBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
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
            'index' => Pages\ListKitchenBookings::route('/'),
            'create' => Pages\CreateKitchenBooking::route('/create'),
            'edit' => Pages\EditKitchenBooking::route('/{record}/edit'),
        ];
    }
}
