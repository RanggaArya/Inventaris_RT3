<?php

namespace App\Filament\Resources\AlatKesehatans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AlatKesehatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lokasi.id')
                    ->label('Lokasi'),
                TextEntry::make('kategori.id')
                    ->label('Kategori')
                    ->placeholder('-'),
                TextEntry::make('jenisPerangkat.id')
                    ->label('Jenis perangkat')
                    ->placeholder('-'),
                TextEntry::make('kondisi.id')
                    ->label('Kondisi')
                    ->placeholder('-'),
                TextEntry::make('status.id')
                    ->label('Status')
                    ->placeholder('-'),
                TextEntry::make('bulan')
                    ->placeholder('-'),
                TextEntry::make('tanggal_entry')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('nomor_inventaris')
                    ->placeholder('-'),
                TextEntry::make('nama_jenis_alat'),
                TextEntry::make('merek_alat')
                    ->placeholder('-'),
                TextEntry::make('jumlah_alat')
                    ->numeric(),
                TextEntry::make('tipe_alat')
                    ->placeholder('-'),
                TextEntry::make('nomor_seri')
                    ->placeholder('-'),
                TextEntry::make('distributor')
                    ->placeholder('-'),
                TextEntry::make('supplier')
                    ->placeholder('-'),
                TextEntry::make('no_akl_akd')
                    ->placeholder('-'),
                TextEntry::make('produk')
                    ->placeholder('-'),
                TextEntry::make('tanggal_pembelian')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('tahun_pembelian')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('sumber_pendanaan')
                    ->placeholder('-'),
                TextEntry::make('harga_beli_ppn')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('harga_beli_non_ppn')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('updated_by')
                    ->numeric()
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
