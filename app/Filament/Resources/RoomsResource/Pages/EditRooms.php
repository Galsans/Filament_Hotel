<?php

namespace App\Filament\Resources\RoomsResource\Pages;

use App\Filament\Resources\RoomsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRooms extends EditRecord
{
    protected static string $resource = RoomsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
