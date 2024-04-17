<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UsersResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Admin\Resources\UsersResource\RelationManagers;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 2;
    

    public static function getNavigationLabel(): string
    {
        return __('messages.Users');
    }
    public static function getPluralModelLabel(): string
    {
        return __('messages.Users');
    }
    public static function getModelLabel(): string
    {
        return __('messages.User');
    }






     //Permision Page Settings
     public static function canAccess(): bool
     {
        $active_status = auth()->user()->status;
 
        if($active_status === true){
         return auth()->user()->can_view_user;
        }else{
         return false;
        }
         
     }






    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //


                Section::make('')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('messages.Name'))
                            ->required(),

                        TextInput::make('email')
                            ->label(__('messages.Email'))
                            ->email()
                            ->readOnlyOn('edit')
                            ->unique(ignoreRecord: true)
                            ->required(),

                        TextInput::make('phone_number')
                            ->label(__('messages.PhoneNumber'))
                            ->required(),

                        TextInput::make('password')
                            ->label(__('messages.Password'))
                            ->password()
                            ->required()
                            ->revealable()
                            ->hiddenOn('edit'),

                        TextInput::make('position')
                            ->label(__('messages.Position'))
                            ->required(),

                        Toggle::make('status')
                            ->inline(false)
                            ->default(true)
                            ->label(__('messages.ActiveStatus')),

                        RichEditor::make('address')
                        ->label(__('messages.Address'))
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'link',
                            'strike',
                            'underline',
                        ])


                    ])->columns(2),

                    Section::make(__('messages.Permission'))
                            
                            ->schema([


                                Section::make(__('messages.Settings'))
                                    ->schema([
                                        Toggle::make('currency')->label(__('messages.Currency')),
                                        Toggle::make('language')->label(__('messages.Language')),
                                        Toggle::make('config')->label(__('messages.Config')),
                                        
                                    ])->columns(3),


                                Section::make(__('messages.Users'))
                                    ->schema([
                                        Toggle::make('can_view_user')->label(__('messages.Canviewuser')),
                                        Toggle::make('can_add_user')->label(__('messages.CanAdduser')),
                                        Toggle::make('can_edit_user')->label(__('messages.CanEdituser')),
                                        Toggle::make('can_delete_user')->label(__('messages.CanDeleteuser')),
                                        
                                    ])->columns(4),


                                Section::make(__('messages.Customers'))
                                    ->schema([
                                        Toggle::make('can_view_customer')->label(__('messages.CanviewCustomer')),
                                        Toggle::make('can_add_customer')->label(__('messages.CanAddCustomer')),
                                        Toggle::make('can_edit_customer')->label(__('messages.CanEditCustomer')),
                                        Toggle::make('can_delete_customer')->label(__('messages.CanDeleteCustomer')),
                                        
                                    ])->columns(4),

                                Section::make(__('messages.Hotels'))
                                    ->schema([
                                        Toggle::make('can_view_hotel')->label(__('messages.CanviewHotel')),
                                        Toggle::make('can_add_hotel')->label(__('messages.CanAddHotel')),
                                        Toggle::make('can_edit_hotel')->label(__('messages.CanEditHotel')),
                                        Toggle::make('can_delete_hotel')->label(__('messages.CanDeleteHotel')),
                                    ])->columns(4),

                                    
                                Section::make(__('messages.Expenses'))
                                    ->schema([
                                        Toggle::make('can_view_expense')->label(__('messages.CanviewExpenses')),
                                        Toggle::make('can_add_expense')->label(__('messages.CanAddExpenses')),
                                        Toggle::make('can_edit_expense')->label(__('messages.CanEditExpenses')),
                                        Toggle::make('can_delete_expense')->label(__('messages.CanDeleteExpenses')),
                                        
                                    ])->columns(4),


                                Section::make(__('messages.Booking'))
                                    ->schema([
                                        Toggle::make('can_book_hotel')->label(__('messages.CanBookHotel')),
                                        Toggle::make('can_book_transportation')->label(__('messages.CanBookTransportation')),
                                        Toggle::make('can_book_kitchen')->label(__('messages.CanBookKitchen')),
                                        
                                    ])->columns(3),






                            ])
                            ->description(__('messages.PermissionMessage'))
                            ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label(__('messages.Name'))
                    ->searchable(),
                
                TextColumn::make('email')
                    ->label(__('messages.Email'))
                    ->searchable(),
                
                TextColumn::make('position')
                    ->label(__('messages.Position'))
                    ->searchable(),
                
                TextColumn::make('phone_number')
                    ->label(__('messages.PhoneNumber'))
                    ->searchable(),
                
                ToggleColumn::make('status')
                    ->label(__('messages.ActiveStatus'))
                    ->searchable(),

                
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
