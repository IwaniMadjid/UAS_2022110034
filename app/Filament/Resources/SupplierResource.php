<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Master';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_supplier')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_supplier')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat_supplier')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kontak_supplier')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_supplier')
                    ->searchable()
                    ->label('Kode Supplier'),
                Tables\Columns\TextColumn::make('nama_supplier')
                    ->searchable()
                    ->label('Nama Supplier'),
                Tables\Columns\TextColumn::make('alamat_supplier')
                    ->searchable()
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('kontak_supplier')
                    ->searchable()
                    ->label('Kontak'),
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}