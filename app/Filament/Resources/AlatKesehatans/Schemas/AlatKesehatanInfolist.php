<?php

namespace App\Filament\Resources\AlatKesehatans\Schemas;


use Filament\Infolists\Components\Entry; 
use Filament\Schemas\Schema;

class AlatKesehatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Entry::make('detail_view')
                    ->view('infolists.alat-kesehatan-detail')
                    ->columnSpanFull(),
            ]);
    }
}