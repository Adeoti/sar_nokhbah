<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use App\Models\Expenses;
use App\Models\SiteSetting;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;



class ReportWidget extends BaseWidget
{



    
    protected function getStats(): array
    {

        $expenses = Expenses::sum('amount');
        $balance = Booking::sum('balance');



        $profit = $balance - $expenses;
        $profit = number_format($profit,2);

            $expenses = number_format($expenses,2);
            $balance = number_format($balance,2);
                $expenses = SiteSetting::first()->currency." ".$expenses;
                $balance = SiteSetting::first()->currency." ".$balance;
                $profit = SiteSetting::first()->currency." ".$profit;

        return [
            Stat::make(__('messages.Expenses'),$expenses),
            Stat::make(__('messages.Balance'),$balance)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success')
            ,

            Stat::make(__('messages.Profit'),$profit)
                
            ,
        ];
    }
}
