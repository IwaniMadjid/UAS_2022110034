<?php

namespace App\Filament\Resources\BeliResource\Pages;

use App\Filament\Resources\BeliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBelis extends ListRecords
{
    protected static string $resource = BeliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
