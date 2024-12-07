<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoothResource\Pages;
use App\Filament\Resources\BoothResource\RelationManagers;
use App\Models\Booth;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BoothResource extends Resource
{
    protected static ?string $model = Booth::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_booth')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kode_booth')
                    ->required()
                    ->maxLength(255),
                    Select::make('jenis_booth')
                    ->options([
                        'Beverage' => 'Beverage',
                        'Dessert' => 'Dessert',
                        'Snack' => 'Snack',
                        'Makanan Berat' => 'Makanan Berat',
                    ])
                    ->required()
                    ->placeholder('Pilih Jenis Booth'),
                Forms\Components\TextInput::make('pemilik_booth')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kontak_booth')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\FileUpload::make('image_booth')
                //     ->image()
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_booth')
                    ->searchable()
                    ->label('Nama Booth'),
                Tables\Columns\TextColumn::make('kode_booth')
                    ->searchable()
                    ->label('Kode Booth'),
                Tables\Columns\TextColumn::make('jenis_booth')
                    ->searchable()
                    ->label('Jenis Booth'),
                Tables\Columns\TextColumn::make('pemilik_booth')
                    ->searchable()
                    ->label('Nama Pemilik'),
                Tables\Columns\TextColumn::make('kontak_booth')
                    ->searchable()
                    ->label('Kontak Pemilik'),
                Tables\Columns\ImageColumn::make('image_booth')
                    ->label('Gambar Booth'),

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
            'index' => Pages\ListBooths::route('/'),
            'create' => Pages\CreateBooth::route('/create'),
            'edit' => Pages\EditBooth::route('/{record}/edit'),
        ];
    }
}
