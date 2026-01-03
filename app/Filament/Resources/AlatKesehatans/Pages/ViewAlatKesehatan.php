<?php

namespace App\Filament\Resources\AlatKesehatans\Pages;

use App\Filament\Resources\AlatKesehatans\AlatKesehatanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAlatKesehatan extends ViewRecord
{
    protected static string $resource = AlatKesehatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
