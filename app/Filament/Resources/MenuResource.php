<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

use function Laravel\Prompts\select;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Master';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_menu')
                    ->required(),
                TextInput::make('harga_jual_menu')
                    ->required()
                    ->numeric(),
                TextInput::make('kode_menu')
                    ->required(),
                TextInput::make('harga_beli_menu')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('nama_menu')
                ->label ('Nama Menu')
                ->searchable()
                ->limit(30),
                TextColumn::make('harga_jual_menu')
                ->label('Harga Jual')
                ->numeric()
                ->sortable()
                ->prefix('Rp ')
                ->getStateUsing(fn(Menu $record) => number_format($record->harga_jual_menu, 2, ',', '.')),
                TextColumn::make('harga_beli_menu')
                ->label('Harga Beli')
                ->numeric()
                ->sortable()
                ->prefix('Rp ')
                ->getStateUsing(fn(Menu $record) => number_format($record->harga_beli_menu, 2, ',', '.')),
                TextColumn::make('kode_menu')
                ->label('Kode Menu')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
