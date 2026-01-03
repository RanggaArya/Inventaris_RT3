<?php

namespace App\Filament\Resources\AlatKesehatans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Schemas\Schema;

use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class AlatKesehatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Alat Kesehatan')
                ->tabs([
                    Tab::make('Info Utama')
                        ->columns(3)
                        ->schema([
                            Select::make('lokasi_id')
                                ->label('Lokasi')
                                ->relationship('lokasi', 'nama_lokasi')
                                ->searchable()
                                ->required(),

                            Select::make('kategori_id')
                                ->label('Kategori Alat')
                                ->relationship('kategori', 'nama_kategori')
                                ->searchable()
                                ->required(),

                            Select::make('jenis_perangkat_id')
                                ->label('Jenis Perangkat')
                                ->relationship('jenisPerangkat', 'nama_jenis')
                                ->searchable(),

                            Select::make('kondisi_id')
                                ->label('Kondisi')
                                ->relationship('kondisi', 'nama_kondisi')
                                ->searchable(),

                            Select::make('status_id')
                                ->label('Status')
                                ->relationship('status', 'nama_status')
                                ->searchable(),

                            TextInput::make('bulan')
                                ->maxLength(20)
                                ->placeholder('November'),

                            DatePicker::make('tanggal_entry')
                                ->label('Tanggal Entry'),

                            TextInput::make('nomor_inventaris')
                                ->label('Nomor Inventaris')
                                ->maxLength(255)
                                ->placeholder('-')
                                ->disabled()
                                ->dehydrated()
                                ->placeholder(
                                    fn(string $operation) =>
                                    $operation === 'create' ? 'Akan digenerate otomatis...' : null
                                ),
                        ]),
                    Tab::make('Identitas Alat')
                        ->columns(3)
                        ->schema([
                            TextInput::make('nama_jenis_alat')
                                ->label('Nama/Jenis Alat')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('merek_alat')
                                ->label('Merek Alat')
                                ->maxLength(255),

                            TextInput::make('jumlah_alat')
                                ->label('Jumlah Alat')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->default(1),

                            TextInput::make('tipe_alat')
                                ->label('Tipe Alat')
                                ->maxLength(255),

                            TextInput::make('nomor_seri')
                                ->label('Nomor Seri')
                                ->maxLength(255),
                        ]),

                    Tab::make('Distribusi / Registrasi')
                        ->columns(3)
                        ->schema([
                            TextInput::make('distributor')->maxLength(255),
                            TextInput::make('supplier')->maxLength(255),
                            TextInput::make('no_akl_akd')->label('No AKL/AKD')->maxLength(255),
                            TextInput::make('produk')->maxLength(255),
                        ]),

                    Tab::make('Pembelian & Harga')
                        ->columns(3)
                        ->schema([
                            DatePicker::make('tanggal_pembelian')
                                ->label('Tanggal Pembelian'),

                            TextInput::make('tahun_pembelian')
                                ->label('Tahun Pembelian')
                                ->numeric()
                                ->required()
                                ->default(date('Y'))
                                ->minValue(1900)
                                ->maxValue(2100),

                            TextInput::make('sumber_pendanaan')
                                ->label('Sumber Pendanaan')
                                ->maxLength(255),

                            TextInput::make('harga_beli_ppn')
                                ->label('Harga Beli (PPN)')
                                ->numeric()
                                ->minValue(0)
                                ->prefix('Rp'),

                            TextInput::make('harga_beli_non_ppn')
                                ->label('Harga Beli (Non PPN)')
                                ->numeric()
                                ->minValue(0)
                                ->prefix('Rp'),

                            Textarea::make('keterangan')
                                ->label('Keterangan')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
        ]);
    }
}
