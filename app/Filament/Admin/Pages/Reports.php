<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.reports';
    protected static ?string $navigationGroup = "Accounting";





    
     //Permision Page Settings
     public static function canAccess(): bool
     {
        $active_status = auth()->user()->status;
 
        if($active_status === true){
         return auth()->user()->config;
        }else{
         return false;
        }
         
     }

    
    public static function getNavigationGroup(): ?string
    {
        return __('messages.Accounting');
    }


    public static function getNavigationLabel(): string
    {
        return __('messages.Reports');
    }


}
