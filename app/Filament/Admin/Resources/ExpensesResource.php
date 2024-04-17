<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Expenses;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\ExpensesResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Admin\Resources\ExpensesResource\RelationManagers;
use App\Filament\Admin\Resources\ExpensesResource\Pages\EditExpenses;
use App\Filament\Admin\Resources\ExpensesResource\Pages\ListExpenses;
use App\Filament\Admin\Resources\ExpensesResource\Pages\CreateExpenses;

class ExpensesResource extends Resource
{
    protected static ?string $model = Expenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?string $navigationGroup = "Accounting";








    
    public static function getNavigationGroup(): ?string
    {
        return __('messages.Accounting');
    }

    
    public static function getNavigationLabel(): string
    {
        return __('messages.Expenses');
    }

    public static function getPluralModelLabel(): string
    {
        return __('messages.Expenses');
    }
    public static function getModelLabel(): string
    {
        return __('messages.Expenses');
    }




//Permision Page Settings
public static function canAccess(): bool
{
   $active_status = auth()->user()->status;

   if($active_status === true){
    return auth()->user()->can_view_expense;
   }else{
    return false;
   }
    
}



    public static function form(Form $form): Form
    {
        $userId = Auth()->id();
        return $form
            ->schema([
               Section::make('')->schema([
                Section::make(__('messages.PrimaryInfo'))->schema([
                    TextInput::make('title')
                        ->label(__('messages.Title'))
                        
                        ->required()
                    ,
                   
                    TextInput::make('amount')
                        ->label(__('messages.Amount'))
                        ->required()
                        ->numeric()
                        ->inputMode('decimal')
                    ,
                    DatePicker::make('dated')
                        ->required()
                        ->label(__('messages.Dated'))
                        ->placeholder('MM/DD/YYYY')
                        ->native(false)
                        //->date()
                    ,
                    Hidden::make('user_id')->default($userId)
                ])->columnSpan(1)
                ,
                Section::make(__('messages.Note'))->schema([
                    RichEditor::make('note')
                    ->label('')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ])
                    ,
                ])->columnSpan(1)
               ])->columns(2)

            ])
            
            ;
    }

    public static function table(Table $table): Table
    {

        $system_curency = "USD";

        return $table
            ->columns([
                //
                TextColumn::make('title')
                    ->label(__('messages.Title'))
                    ->searchable(),
                TextColumn::make('note')
                    ->words(4)
                    ->markdown()
                    ->toggleable()
                    ,
                TextColumn::make('amount')
                    ->label(__('messages.Amount'))
                    ->searchable()
                    ->sortable()
                    ->money($system_curency)
                ,
                TextColumn::make('dated')
                    ->label(__('messages.Dated'))
                    ->date()
                    ->sortable()
                    ,
                TextColumn::make('user.name')
                    ->label(__('messages.AddedBy'))
                    ->toggleable()
                    ,
                TextColumn::make('created_at')
                    ->date()
                    ->label(__('messages.CreatedOn'))
                    ->sortable()
                    

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpenses::route('/create'),
            'edit' => Pages\EditExpenses::route('/{record}/edit'),
        ];
    }
}
