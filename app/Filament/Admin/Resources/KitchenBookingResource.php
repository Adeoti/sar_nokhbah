<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SiteSetting;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\KitchenBookingResource\Pages;
use App\Filament\Admin\Resources\KitchenBookingResource\RelationManagers;

class KitchenBookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = "Booking";






    
    public static function getNavigationGroup(): ?string
    {
        return __('messages.Booking');
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.KitchenBooking');
    }
    public static function getPluralModelLabel(): string
    {
        return __('messages.KitchenBookings');
    }
    public static function getModelLabel(): string
    {
        return __('messages.Booking');
    }


     //Permision Page Settings
     public static function canAccess(): bool
     {
        $active_status = auth()->user()->status;
 
        if($active_status === true){
         return auth()->user()->can_book_kitchen;
        }else{
         return false;
        }
         
     }
    
    protected static ?string $title = "Kitchen Bookings";
    protected static ?string $navigationLabel = "Kitchen Bookings";
    protected static ?string $pluralModelLabel = "Kitchen Bookings";
    protected  ?string $heading = "Kitchen Bookings";

    protected static ?string $navigationBadgeTooltip = "Active Kitchen Bookings";
    public static function getNavigationBadge(): ?string
    {
        return Booking::where('type','kitchen')->where('status','Active')->count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'success';
    }

    public static function getEloquentQuery(): Builder
    {
        return Booking::where('type','kitchen');
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
        $currency = "";

        $reference_code = "Nokhabah_KT_".date('Ymdhis').uniqid();

        //dd($reference_code);

        $sitecurrency = SiteSetting::first()->currency;

        if(!empty($sitecurrency)){
            $currency = $sitecurrency;
        }else{
            $currency = "USD";
        }


        return $form
            ->schema([
                //

                Section::make('')
                    
                    ->schema([
                        

                            Hidden::make('hotel_id')->default(0),
                            Hidden::make('type')->default('kitchen'),

                Select::make('customer_id')
                    ->searchable()
                    ->required()
                    ->label(__('messages.Customer'))
                    ->options(Customer::all()->pluck('name','id'))
                    ->createOptionForm([
                                    
                Section::make('')
                ->schema([
                    TextInput::make('name')
                        ->label(__('messages.Name'))
                        ->required(),

                    TextInput::make('email')
                        ->label(__('messages.Email'))
                        ->email()
                        ,

                    TextInput::make('phone_number')
                        ->label(__('messages.PhoneNumber'))
                        ->required()
                        ,
                    Select::make('country')
                        ->label(__('messages.Country'))
                        ->options($countries)
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
                                ])
                                ->createOptionUsing( function (array $data) : int{
                                    return Customer::create($data)->getKey();
                                }

                            ),


                            Hidden::make('user_id')->default(auth()->id()),
                            DateTimePicker::make('start_at')
                                ->label(__('messages.StartAt')),

                            DateTimePicker::make('end_at')
                                ->label(__('messages.EndAt')),


                                Section::make('')
                                    ->schema([

                                        TextInput::make('credit')
                                            ->numeric()
                                            ->label(__('messages.Credit'))
                                            ->live()
                                            ->required()
                                            ->prefix($currency)
                                            ->afterStateUpdated(function(callable $get, $set, $state){
                                                
                                                if($get('vat') != null && $get('debit') != null){
                                                    $total_debit = $get('vat')+$get('debit');
                                                    $balance = $total_debit - $get('credit');

                                                    $set('total_debit', $total_debit);
                                                    $set('balance', $balance);
                                                }
                                            }),

                                        TextInput::make('vat')
                                            ->label(__('messages.VAT'))
                                            ->numeric()
                                            ->afterStateUpdated(function(callable $get, $set, $state){
                                                
                                                if($get('vat') != null && $get('debit') != null){
                                                    $total_debit = $get('vat')+$get('debit');
                                                    $balance = $total_debit - $get('credit');

                                                    $set('total_debit', $total_debit);
                                                    $set('balance', $balance);
                                                }
                                            })

                                            ->live()
                                            ->required()
                                            ->prefix($currency),

                                        TextInput::make('debit')
                                            ->label(__('messages.Debit'))
                                            ->numeric()
                                            ->live()
                                            ->afterStateUpdated(function(callable $get, $set, $state){
                                                
                                                if($get('vat') != null && $get('debit') != null){
                                                    $total_debit = $get('vat')+$get('debit');
                                                    $balance = $total_debit - $get('credit');

                                                    $set('total_debit', $total_debit);
                                                    $set('balance', $balance);
                                                }
                                            })
                                            ->prefix($currency)
                                            ->required()
                                            ,

                                        Select::make('status')
                                            ->label(__('messages.Status'))
                                            ->searchable()
                                            ->required()
                                            ->options([
                                                'Active' => 'Active',
                                                'Completed' => 'Completed',
                                                'Cancelled' => 'Cancelled'

                                            ]),


                                            TextInput::make('total_debit')
                                            ->label(__('messages.TotalDebit'))
                                            ->readOnly(),
                                            TextInput::make('balance')
                                            ->label(__('messages.Balance'))
                                            ->readOnly()
                                            ,

                                    ])->columns(4),

                                RichEditor::make('note')
                                    ->label(__('messages.OrderInfo'))
                                    ->columnSpan(2)
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'link',
                                        'strike',
                                    ]),

                                RichEditor::make('property_details')
                                    ->label(__('messages.PropertyDetails'))
                                    ->columnSpan(1)
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'link',
                                        'strike',
                                    ]),



                                Hidden::make('reference_code')
                                    ->default($reference_code)

                    ])->columns(3)


            ]);
    }

    public static function table(Table $table): Table
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
            ->columns([
                //
       


                TextColumn::make('reference_code')
                    ->label(__('messages.ReferenceCode'))
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Reference code copied!')
                    ->toggleable(),


                TextColumn::make('note')
                    ->label(__('messages.OrderInfo'))
                    ->searchable()
                    ->markdown()
                    ->words(6)
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('customer.name')
                    ->label(__('messages.Customer'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('start_at')
                    ->label(__('messages.StartAt'))
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('end_at')
                    ->label(__('messages.EndAt'))
                    ->dateTime()
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
