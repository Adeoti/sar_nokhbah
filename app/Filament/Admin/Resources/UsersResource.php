<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UsersResource\Pages;
use App\Filament\Admin\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //


                Section::make('')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),

                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->readOnlyOn('edit')
                            ->unique(ignoreRecord: true)
                            ->required(),

                        TextInput::make('phone_number')
                            ->label(__('Phone Number'))
                            ->required(),

                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->revealable()
                            ->hiddenOn('edit'),

                        TextInput::make('position')
                            ->label(__('Position'))
                            ->required(),

                        Toggle::make('status')
                            ->inline(false)
                            ->default(true)
                            ->label(__('Active Status')),

                        RichEditor::make('address')
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'link',
                            'strike',
                            'underline',
                        ])


                    ])->columns(2),

                    Section::make(__('Permission'))
                            
                            ->schema([


                                Section::make('Settings')
                                    ->schema([
                                        Toggle::make('currency'),
                                        Toggle::make('language'),
                                        Toggle::make('config'),
                                        
                                    ])->columns(3),


                                Section::make('Users')
                                    ->schema([
                                        Toggle::make('can_view_user'),
                                        Toggle::make('can_add_user'),
                                        Toggle::make('can_edit_user'),
                                        Toggle::make('can_delete_user'),
                                        
                                    ])->columns(4),


                                Section::make('Customers')
                                    ->schema([
                                        Toggle::make('can_view_customer'),
                                        Toggle::make('can_add_customer'),
                                        Toggle::make('can_edit_customer'),
                                        Toggle::make('can_delete_customer'),
                                        
                                    ])->columns(4),

                                Section::make('Hotels')
                                    ->schema([
                                        Toggle::make('can_view_hotel'),
                                        Toggle::make('can_add_hotel'),
                                        Toggle::make('can_edit_hotel'),
                                        Toggle::make('can_delete_hotel'),
                                        
                                    ])->columns(4),

                                    
                                Section::make('Expenses')
                                    ->schema([
                                        Toggle::make('can_view_expense'),
                                        Toggle::make('can_add_expense'),
                                        Toggle::make('can_edit_expense'),
                                        Toggle::make('can_delete_expense'),
                                        
                                    ])->columns(4),


                                Section::make('Booking')
                                    ->schema([
                                        Toggle::make('can_book_hotel'),
                                        Toggle::make('can_book_transportation'),
                                        Toggle::make('can_book_kitchen'),
                                        
                                    ])->columns(3),






                            ])
                            ->description(__('Set the actions that can be performed by this user '))
                            ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                
                TextColumn::make('position')
                    ->label(__('Position'))
                    ->searchable(),
                
                TextColumn::make('phone_number')
                    ->label(__('Phone No.'))
                    ->searchable(),
                
                ToggleColumn::make('status')
                    ->label(__('Active Status'))
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
