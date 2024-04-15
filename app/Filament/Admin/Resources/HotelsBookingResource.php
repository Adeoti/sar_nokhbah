<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\HotelsBookingResource\Pages;
use App\Filament\Admin\Resources\HotelsBookingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Tables\Columns\TextColumn;

class HotelsBookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = "Booking";


    protected static ?string $title = "Hotel Bookings";
    protected static ?string $navigationLabel = "Hotel Bookings";
    protected static ?string $pluralModelLabel = "Hotel Bookings";
    protected  ?string $heading = "Hotel Bookings";

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

        $reference_code = "Nokhabah_".date('Ymdhis').uniqid();

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
                        
                        Select::make('name')
                            ->required()
                            ->searchable()
                            ->options(Hotel::all()->pluck('name','id'))
                            ->hintIconTooltip('Add Hotel xxc')
                            ->createOptionForm([
                                
                                        Section::make('')
                                        ->schema([
                                        TextInput::make('name')
                                        ->label(__('Name'))
                                        ->required(),

                                        Select::make('stars')
                                            ->label(__('Stars'))
                                            ->required()
                                            ->searchable()
                                            ->options([
                                                '1 Star' => '1 Star',
                                                '2 Star' => '2 Star',
                                                '3 Star' => '3 Star',
                                                '4 Star' => '4 Star',
                                                '5 Star' => '5 Star',
                                                '6 Star' => '6 Star',
                                                '7 Star' => '7 Star',
                                                '8 Star' => '8 Star',
                                                '9 Star' => '9 Star',
                                                '10 Star' => '10 Star',
                                                '11 Star' => '11 Star',
                                                '12 Star' => '12 Star',
                                                '13 Star' => '13 Star',
                                                '14 Star' => '14 Star',
                                                '15 Star' => '15 Star',
                                                '16 Star' => '16 Star',
                                                '17 Star' => '17 Star',
                                                '18 Star' => '18 Star',
                                                '19 Star' => '19 Star',
                                                '20 Star' => '20 Star',

                                            ]),


                                            RichEditor::make('address')
                                                ->required()
                                                ->toolbarButtons([
                                                    'blockquote',
                                                    'bold',
                                                    'italic',
                                                    'link',
                                                ]),

                                            RichEditor::make('info')
                                                ->label(__('Info'))
                                                ->toolbarButtons([
                                                    'blockquote',
                                                    'bold',
                                                    'italic',
                                                    'link',
                                                ]),

                                                Hidden::make('user_id')->default(auth()->id()),

                                        ])->columns(2)
                            ])
                            ->createOptionUsing(function (array $data): int {
                                return Hotel::create($data)->getKey();
                            }),
    



                            Select::make('customer_id')
                                ->searchable()
                                ->required()
                                ->label('Customer')
                                ->options(Customer::all()->pluck('name','id'))
                                ->createOptionForm([
                                    
                Section::make('')
                ->schema([
                    TextInput::make('name')
                        ->required(),

                    TextInput::make('email')
                        
                        ->email()
                        ,

                    TextInput::make('phone_number')
                        ->required()
                        ,
                    Select::make('country')
                        ->options($countries)
                        ->searchable()
                        ->required()
                    
                        
                ])->columns(4),

                Section::make('')
                    ->schema([
                        RichEditor::make('address')
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
                                ->label('Check In'),

                            DateTimePicker::make('end_at')
                                ->label('Check Out'),


                                Section::make('')
                                    ->schema([

                                        TextInput::make('credit')
                                            ->numeric()
                                            ->prefix($currency),

                                        TextInput::make('vat')
                                            ->numeric()
                                            ->prefix($currency),

                                        TextInput::make('debit')
                                            ->numeric()
                                            ->prefix($currency),

                                        Select::make('status')
                                            ->searchable()
                                            
                                            ->options([
                                                'Active' => 'Active',
                                                'Completed' => 'Completed',
                                                'Cancelled' => 'Cancelled'

                                            ])


                                    ])->columns(4),

                                RichEditor::make('note')
                                    ->label('Booking Info')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'link',
                                        'strike',
                                    ]),

                                RichEditor::make('property_details')
                                    ->label('Room Details')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'link',
                                        'strike',
                                    ]),



                                Hidden::make('reference_code')
                                    ->default($reference_code)

                    ])->columns(2)


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //


                TextColumn::make('hotel.name')
                    ->label('Hotel Name')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->toggleable(),

                
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
            'index' => Pages\ListHotelsBookings::route('/'),
            'create' => Pages\CreateHotelsBooking::route('/create'),
            'edit' => Pages\EditHotelsBooking::route('/{record}/edit'),
        ];
    }
}
