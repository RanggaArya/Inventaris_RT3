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
                
                // 3. Gunakan Entry::make() lalu chain dengan ->view()
                Entry::make('detail_view') // Nama bebas, hanya identifier
                    ->view('infolists.alat-kesehatan-detail') // Arahkan ke file blade Anda
                    ->columnSpanFull(), // Penting: Agar tampilan memenuhi lebar container
            ]);
    }
}