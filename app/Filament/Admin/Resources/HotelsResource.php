<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HotelsResource\Pages;
use App\Filament\Admin\Resources\HotelsResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelsResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = 3;

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
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('Name')),
                TextColumn::make('stars')
                    ->searchable()
                    ->label(__('Stars')),
                TextColumn::make('address')
                    ->searchable()
                    ->markdown()
                    ->words(7)
                    ->label(__('Address')),
                TextColumn::make('created_at')
                    ->searchable()
                    ->since()
                    ->label(__('Added Since')),
                TextColumn::make('user.name')
                    ->searchable()
                    ->label(__('Added By')),


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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotels::route('/create'),
            'edit' => Pages\EditHotels::route('/{record}/edit'),
        ];
    }
}
