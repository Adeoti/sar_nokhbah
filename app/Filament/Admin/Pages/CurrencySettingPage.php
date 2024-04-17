<?php

namespace App\Filament\Admin\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\DB;

class CurrencySettingPage extends Page implements HasForms
{


    use InteractsWithForms;
    public ?array $data = [];
    


    public static function getNavigationLabel(): string
    {
        return __('messages.Currencies');
    }




    //Permision Page Settings
    public static function canAccess(): bool
    {
       $active_status = auth()->user()->status;

       if($active_status === true){
        return auth()->user()->currency;
       }else{
        return false;
       }
        
    }


    public function getHeading(): string{
        return __('messages.CurrencySettings');
    }






    
    public static function getNavigationGroup(): ?string
    {
        return __('messages.Settings');
    }

    public function mount(): void
    {
        $this->form->fill(
            SiteSetting::all()->first()->toArray()
        );
    }

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = "Currencies";

    protected static string $view = 'filament.admin.pages.currency-setting-page';
    protected static ?string $navigationGroup = "Settings";

    protected  ?string $heading = "Currency Settings";
    protected static ?string $title = "Currency Settings";


    public function form(Form $form ): Form{
        return $form->schema([
            Section::make()->schema([
                Select::make('currency')
                    ->required()
                    ->label(__('messages.Currency'))
                    ->searchable()
                    ->options([
                        'USD' => 'USD',
                        'SAR' => 'Riyal',
                        'NGN' => 'NGN'
                    ])
            ]),
        ])
        ->statePath('data')
        ;
    }



    public function setCurrency(): void{
        $currency = $this->form->getState()['currency'];


            if(isset($currency)){

                $settings_count = SiteSetting::count();
                

                if($settings_count > 0){
                    DB::table('site_settings')
                        ->update([
                            'currency' => $currency
                        ]);
                    
                        
                    $this->dispatch(
                        'alert',
                        title: 'Currency Updated',
                        text: 'You\'ve successfully updated the app currency',
                        type: 'success',
                        button: 'Got it'
                    );
                    
                }else{
                    SiteSetting::create([
                        'currency' => $currency
                    ]);


                    $this->dispatch(
                        'alert',
                        title: 'Currency Updated',
                        text: 'You\'ve successfully updated the app currency',
                        type: 'success',
                        button: 'Got it'
                    );

                }

            }
    }




}
