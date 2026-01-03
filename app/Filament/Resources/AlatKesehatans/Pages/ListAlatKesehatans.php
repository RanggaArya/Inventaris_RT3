<?php

namespace App\Filament\Resources\AlatKesehatans\Pages;

use App\Filament\Resources\AlatKesehatans\AlatKesehatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAlatKesehatans extends ListRecords
{
    protected static string $resource = AlatKesehatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
