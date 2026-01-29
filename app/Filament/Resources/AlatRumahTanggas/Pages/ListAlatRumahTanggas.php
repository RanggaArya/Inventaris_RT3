<?php

namespace App\Filament\Resources\AlatRumahTanggas\Pages;

use App\Filament\Resources\AlatRumahTanggas\AlatRumahTanggaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Filament\Actions\Action;

class ListAlatRumahTanggas extends ListRecords
{
    protected static string $resource = AlatRumahTanggaResource::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        return [
            CreateAction::make(),
            Action::make('export_excel')
            ->label('Download Excel')
            ->icon('heroicon-o-document-arrow-down')
            ->url(route('export.perangkat.all.excel'), shouldOpenInNewTab:true)
            ->color('success')
        ];
    }
}
