<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //

            Stat::make(__('messages.TotalHotels'), Booking::where('type','hotel')->where('status','Active')->count())
                ->description(__('messages.ActiveHotelBoookings'))
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success')
            ,

            Stat::make(__('messages.TotalKitchens'), Booking::where('type','kitchen')->where('status','Active')->count())
                ->description(__('messages.ActiveCateringOrders'))
                ->chart([1, 2, 12, 0, 11, 3, 90])
                ->color('warning')
            ,

            Stat::make(__('messages.TotalTransportations'), Booking::where('type','transportation')->where('status','Active')->count())
                ->description(__('messages.ActiveTransportationBoookings'))
                ->chart([2, 1, 1, 6, 1, 2, 10])
                ->color('info')
            ,
        ];
    }
}
