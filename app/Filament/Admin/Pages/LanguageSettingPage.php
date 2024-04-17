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

class LanguageSettingPage extends Page implements HasForms
{


    use InteractsWithForms;
    public ?array $data = [];
    
    public function mount(): void
    {
        $this->form->fill(
            SiteSetting::all()->first()->toArray()
        );
    }

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = "Languages";

    protected static string $view = 'filament.admin.pages.language-setting-page';
    protected static ?string $navigationGroup = "Settings";

    protected  ?string $heading = "Language Settings";
    protected static ?string $title = "Language Settings";



    public static function getNavigationGroup(): ?string
    {
        return __('messages.Settings');
    }
    public static function getNavigationLabel(): string
    {
        return __('messages.Languages');
    }

    
    //Permision Page Settings
    public static function canAccess(): bool
    {
       $active_status = auth()->user()->status;

       if($active_status === true){
        return auth()->user()->language;
       }else{
        return false;
       }
        
    }


    public function getHeading(): string{
        return __('messages.LanguageSettings');
    }






    public function form(Form $form ): Form{
        return $form->schema([
            Section::make()->schema([
                Select::make('language')
                    ->label(__('messages.Language'))
                    ->searchable()
                    ->options([
                        'en' => 'English',
                        'ar' => 'Arabic',
                        'fr' => 'French'
                    ])
            ]),
        ])
        ->statePath('data')
        ;
    }



    public function setLang(): void{
        $language = $this->form->getState()['language'];


            if(isset($language)){

                $settings_count = SiteSetting::count();
                

                if($settings_count > 0){
                    DB::table('site_settings')
                        ->update([
                            'language' => $language
                        ]);
                    
                        
                    $this->dispatch(
                        'alert',
                        title: 'Language Updated',
                        text: 'You\'ve successfully updated the app Language',
                        type: 'success',
                        button: 'Got it'
                    );
                    
                }else{
                    SiteSetting::create([
                        'language' => $language
                    ]);


                    $this->dispatch(
                        'alert',
                        title: 'Language Updated',
                        text: 'You\'ve successfully updated the app Language',
                        type: 'success',
                        button: 'Got it'
                    );

                }

            }
    }




}
