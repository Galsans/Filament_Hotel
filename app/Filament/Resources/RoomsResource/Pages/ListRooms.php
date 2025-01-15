<?php

namespace App\Filament\Resources\RoomsResource\Pages;

use App\Filament\Resources\RoomsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRooms extends ListRecords
{
    protected static string $resource = RoomsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
