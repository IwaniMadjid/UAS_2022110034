<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeliResource\Pages;
use App\Filament\Resources\BeliResource\RelationManagers;
use App\Models\Beli;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\select;

class BeliResource extends Resource
{
    protected static ?string $model = Beli::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_beli')
                ->required(),
                Select::make('kode_menu')
                ->multiple()
                ->relationship('menu', 'nama_menu'),
                Select::make('kode_pelanggan')
                ->relationship('pelanggan', 'nama_pelanggan'),
                TextInput::make('jumlah_beli')
                ->required(),
                //TextInput::make('total_harga')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_beli'),
                Tables\Columns\TextColumn::make('nama_menu'),
                Tables\Columns\TextColumn::make('nama_pelanggan'),
                Tables\Columns\TextColumn::make('jumlah_beli'),
                //Tables\Columns\TextColumn::make('total_harga'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
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
            'index' => Pages\ListBelis::route('/'),
            'create' => Pages\CreateBeli::route('/create'),
            'edit' => Pages\EditBeli::route('/{record}/edit'),
        ];
    }
}
