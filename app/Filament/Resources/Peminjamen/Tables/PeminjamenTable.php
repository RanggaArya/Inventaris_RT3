<?php

namespace App\Filament\Resources\Peminjamen\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeminjamenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_inventaris')->label('No. Inv')->searchable(),
                TextColumn::make('nama_barang')->searchable(),
                TextColumn::make('pihak_kedua_nama')->label('Peminjam'),
                TextColumn::make('tanggal_mulai')->date('d/m/Y'),
                TextColumn::make('tanggal_selesai')->date('d/m/Y'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state === 'Menunggu' ? 'Menunggu acc' : $state)
                    ->color(fn(string $state): string => match ($state) {
                        'Menunggu'     => 'gray',
                        'Dipinjam'     => 'warning',
                        'Dikembalikan' => 'success',
                        'Terlambat'    => 'danger',
                        'Ditolak'      => 'danger',
                        default        => 'secondary',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
