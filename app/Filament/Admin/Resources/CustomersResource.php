<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\CustomersResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Admin\Resources\CustomersResource\RelationManagers;

class CustomersResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('messages.Customers');
    }

    public static function getPluralModelLabel(): string
    {
        return __('messages.Customers');
    }
    public static function getModelLabel(): string
    {
        return __('messages.Customer');
    }


     //Permision Page Settings
     public static function canAccess(): bool
     {
        $active_status = auth()->user()->status;
 
        if($active_status === true){
         return auth()->user()->can_view_customer;
        }else{
         return false;
        }
         
     }



    public static function form(Form $form): Form
    {

        $countries = [
            'Afghanistan' => 'Afghanistan',
            'Albania' => 'Albania',
            'Algeria' => 'Algeria',
            'Andorra' => 'Andorra',
            'Angola' => 'Angola',
            'Antigua and Barbuda' => 'Antigua and Barbuda',
            'Argentina' => 'Argentina',
            'Armenia' => 'Armenia',
            'Australia' => 'Australia',
            'Austria' => 'Austria',
            'Azerbaijan' => 'Azerbaijan',
            'Bahamas' => 'Bahamas',
            'Bahrain' => 'Bahrain',
            'Bangladesh' => 'Bangladesh',
            'Barbados' => 'Barbados',
            'Belarus' => 'Belarus',
            'Belgium' => 'Belgium',
            'Belize' => 'Belize',
            'Benin' => 'Benin',
            'Bhutan' => 'Bhutan',
            'Bolivia' => 'Bolivia',
            'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
            'Botswana' => 'Botswana',
            'Brazil' => 'Brazil',
            'Brunei' => 'Brunei',
            'Bulgaria' => 'Bulgaria',
            'Burkina Faso' => 'Burkina Faso',
            'Burundi' => 'Burundi',
            'Cabo Verde' => 'Cabo Verde',
            'Cambodia' => 'Cambodia',
            'Cameroon' => 'Cameroon',
            'Canada' => 'Canada',
            'Central African Republic' => 'Central African Republic',
            'Chad' => 'Chad',
            'Chile' => 'Chile',
            'China' => 'China',
            'Colombia' => 'Colombia',
            'Comoros' => 'Comoros',
            'Congo' => 'Congo',
            'Costa Rica' => 'Costa Rica',
            'Croatia' => 'Croatia',
            'Cuba' => 'Cuba',
            'Cyprus' => 'Cyprus',
            'Czech Republic' => 'Czech Republic',
            'Denmark' => 'Denmark',
            'Djibouti' => 'Djibouti',
            'Dominica' => 'Dominica',
            'Dominican Republic' => 'Dominican Republic',
            'East Timor' => 'East Timor',
            'Ecuador' => 'Ecuador',
            'Egypt' => 'Egypt',
            'El Salvador' => 'El Salvador',
            'Equatorial Guinea' => 'Equatorial Guinea',
            'Eritrea' => 'Eritrea',
            'Estonia' => 'Estonia',
            'Eswatini' => 'Eswatini',
            'Ethiopia' => 'Ethiopia',
            'Fiji' => 'Fiji',
            'Finland' => 'Finland',
            'France' => 'France',
            'Gabon' => 'Gabon',
            'Gambia' => 'Gambia',
            'Georgia' => 'Georgia',
            'Germany' => 'Germany',
            'Ghana' => 'Ghana',
            'Greece' => 'Greece',
            'Grenada' => 'Grenada',
            'Guatemala' => 'Guatemala',
            'Guinea' => 'Guinea',
            'Guinea-Bissau' => 'Guinea-Bissau',
            'Guyana' => 'Guyana',
            'Haiti' => 'Haiti',
            'Honduras' => 'Honduras',
            'Hungary' => 'Hungary',
            'Iceland' => 'Iceland',
            'India' => 'India',
            'Indonesia' => 'Indonesia',
            'Iran' => 'Iran',
            'Iraq' => 'Iraq',
            'Ireland' => 'Ireland',
            'Israel' => 'Israel',
            'Italy' => 'Italy',
            'Jamaica' => 'Jamaica',
            'Japan' => 'Japan',
            'Jordan' => 'Jordan',
            'Kazakhstan' => 'Kazakhstan',
            'Kenya' => 'Kenya',
            'Kiribati' => 'Kiribati',
            'Korea, North' => 'Korea, North',
            'Korea, South' => 'Korea, South',
            'Kosovo' => 'Kosovo',
            'Kuwait' => 'Kuwait',
            'Kyrgyzstan' => 'Kyrgyzstan',
            'Laos' => 'Laos',
            'Latvia' => 'Latvia',
            'Lebanon' => 'Lebanon',
            'Lesotho' => 'Lesotho',
            'Liberia' => 'Liberia',
            'Libya' => 'Libya',
            'Liechtenstein' => 'Liechtenstein',
            'Lithuania' => 'Lithuania',
            'Luxembourg' => 'Luxembourg',
            'Madagascar' => 'Madagascar',
            'Malawi' => 'Malawi',
            'Malaysia' => 'Malaysia',
            'Maldives' => 'Maldives',
            'Mali' => 'Mali',
            'Malta' => 'Malta',
            'Marshall Islands' => 'Marshall Islands',
            'Mauritania' => 'Mauritania',
            'Mauritius' => 'Mauritius',
            'Mexico' => 'Mexico',
            'Micronesia' => 'Micronesia',
            'Moldova' => 'Moldova',
            'Monaco' => 'Monaco',
            'Mongolia' => 'Mongolia',
            'Montenegro' => 'Montenegro',
            'Morocco' => 'Morocco',
            'Mozambique' => 'Mozambique',
            'Myanmar' => 'Myanmar',
            'Namibia' => 'Namibia',
            'Nauru' => 'Nauru',
            'Nepal' => 'Nepal',
            'Netherlands' => 'Netherlands',
            'New Zealand' => 'New Zealand',
            'Nicaragua' => 'Nicaragua',
            'Niger' => 'Niger',
            'Nigeria' => 'Nigeria',
            'North Macedonia' => 'North Macedonia',
            'Norway' => 'Norway',
            'Oman' => 'Oman',
            'Pakistan' => 'Pakistan',
            'Palau' => 'Palau',
            'Palestine' => 'Palestine',
            'Panama' => 'Panama',
            'Papua New Guinea' => 'Papua New Guinea',
            'Paraguay' => 'Paraguay',
            'Peru' => 'Peru',
            'Philippines' => 'Philippines',
            'Poland' => 'Poland',
            'Portugal' => 'Portugal',
            'Qatar' => 'Qatar',
            'Romania' => 'Romania',
            'Russia' => 'Russia',
            'Rwanda' => 'Rwanda',
            'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
            'Saint Lucia' => 'Saint Lucia',
            'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines',
            'Samoa' => 'Samoa',
            'San Marino' => 'San Marino',
            'Sao Tome and Principe' => 'Sao Tome and Principe',
            'Saudi Arabia' => 'Saudi Arabia',
            'Senegal' => 'Senegal',
            'Serbia' => 'Serbia',
            'Seychelles' => 'Seychelles',
            'Sierra Leone' => 'Sierra Leone',
            'Singapore' => 'Singapore',
            'Slovakia' => 'Slovakia',
            'Slovenia' => 'Slovenia',
            'Solomon Islands' => 'Solomon Islands',
            'Somalia' => 'Somalia',
            'South Africa' => 'South Africa',
            'South Sudan' => 'South Sudan',
            'Spain' => 'Spain',
            'Sri Lanka' => 'Sri Lanka',
            'Sudan' => 'Sudan',
            'Suriname' => 'Suriname',
            'Sweden' => 'Sweden',
            'Switzerland' => 'Switzerland',
            'Syria' => 'Syria',
            'Taiwan' => 'Taiwan',
            'Tajikistan' => 'Tajikistan',
            'Tanzania' => 'Tanzania',
            'Thailand' => 'Thailand',
            'Togo' => 'Togo',
            'Tonga' => 'Tonga',
            'Trinidad and Tobago' => 'Trinidad and Tobago',
            'Tunisia' => 'Tunisia',
            'Turkey' => 'Turkey',
            'Turkmenistan' => 'Turkmenistan',
            'Tuvalu' => 'Tuvalu',
            'Uganda' => 'Uganda',
            'Ukraine' => 'Ukraine',
            'United Arab Emirates' => 'United Arab Emirates',
            'United Kingdom' => 'United Kingdom',
            'United States' => 'United States',
            'Uruguay' => 'Uruguay',
            'Uzbekistan' => 'Uzbekistan',
            'Vanuatu' => 'Vanuatu',
            'Vatican City' => 'Vatican City',
            'Venezuela' => 'Venezuela',
            'Vietnam' => 'Vietnam',
            'Yemen' => 'Yemen',
            'Zambia' => 'Zambia',
            'Zimbabwe' => 'imbabwe',
        ];
        
        

        return $form
            ->schema([
                //
                Section::make('')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label(__('messages.Name')),

                        TextInput::make('email')
                            ->label(__('messages.Email'))
                            ->email()
                            ,

                        TextInput::make('phone_number')
                            ->label(__('messages.PhoneNumber'))
                            ->required()
                            ,
                        Select::make('country')
                            ->options($countries)
                            ->label(__('messages.Country'))
                            ->searchable()
                            ->required()
                        
                            
                    ])->columns(4),

                    Section::make('')
                        ->schema([
                            RichEditor::make('address')
                            ->label(__('messages.Address'))
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                            RichEditor::make('info')
                            ->label(__('messages.Info'))
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                            Hidden::make('user_id')->default(auth()->id())
                        ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
           
            ->columns([
                //
                TextColumn::make('name')
                    ->sortable()
                    ->label(__('messages.Name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->label(__('messages.Email'))
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->sortable()
                    ->label(__('messages.PhoneNumber'))
                    ->searchable(),
                TextColumn::make('country')
                    ->label(__('messages.Country'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address')
                    ->sortable()
                    ->markdown()
                    ->words(8)
                    ->label(__('messages.Address'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('messages.AddedOn'))
                    ->toggleable()
                    ->date()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable()
                    ->label(__('messages.AddedBy'))
                
                

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
                   
                    ExportBulkAction::make()
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomers::route('/create'),
            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
