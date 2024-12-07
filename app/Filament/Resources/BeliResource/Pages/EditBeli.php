<?php

namespace App\Filament\Resources\BeliResource\Pages;

use App\Filament\Resources\BeliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeli extends EditRecord
{
    protected static string $resource = BeliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
