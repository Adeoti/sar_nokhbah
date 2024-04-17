<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Hotel;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\HotelsResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Admin\Resources\HotelsResource\RelationManagers;

class HotelsResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = 3;



    //Permision Page Settings
    public static function canAccess(): bool
    {
       $active_status = auth()->user()->status;

       if($active_status === true){
        return auth()->user()->can_view_hotel;
       }else{
        return false;
       }
        
    }



    public static function getNavigationLabel(): string
    {
        return __('messages.Hotels');
    }


    public static function getPluralModelLabel(): string
    {
        return __('messages.Hotels');
    }
    public static function getModelLabel(): string
    {
        return __('messages.Hotel');
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

                    Select::make('stars')
                        ->label(__('messages.Stars'))
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
                            ->label(__('messages.Stars'))
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'italic',
                                'link',
                            ]),

                        RichEditor::make('info')
                            ->label(__('messages.Info'))
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'italic',
                                'link',
                            ]),

                            Hidden::make('user_id')->default(auth()->id()),

                    ])->columns(2)
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('messages.Name')),
                TextColumn::make('stars')
                    ->searchable()
                    ->label(__('messages.Stars')),
                TextColumn::make('address')
                    ->searchable()
                    ->markdown()
                    ->words(7)
                    ->label(__('messages.Address')),
                TextColumn::make('created_at')
                    ->searchable()
                    ->since()
                    ->label(__('messages.AddedSince')),
                TextColumn::make('user.name')
                    ->searchable()
                    ->label(__('messages.AddedBy')),


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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotels::route('/create'),
            'edit' => Pages\EditHotels::route('/{record}/edit'),
        ];
    }
}
