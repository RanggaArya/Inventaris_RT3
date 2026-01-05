<?php

namespace App\Filament\Resources\Mutasis\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MutasiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('perangkat.nama_perangkat')
                    ->label('Perangkat')
                    ->placeholder('-'),
                TextEntry::make('lokasiMutasi.nama_lokasi')
                    ->label('Lokasi mutasi')
                    ->placeholder('-'),
                TextEntry::make('nama_perangkat')
                    ->placeholder('-'),
                TextEntry::make('nomor_inventaris')
                    ->placeholder('-'),
                TextEntry::make('tipe')
                    ->placeholder('-'),
                TextEntry::make('lokasiAsal.nama_lokasi')
                    ->label('Lokasi asal')
                    ->placeholder('-'),
                TextEntry::make('kondisi.nama_kondisi')
                    ->label('Kondisi')
                    ->placeholder('-'),
                TextEntry::make('tanggal_mutasi')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('tanggal_diterima')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('alasan_mutasi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('user.name')
                    ->label('User')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
