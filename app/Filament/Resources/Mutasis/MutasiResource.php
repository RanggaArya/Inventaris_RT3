<?php

namespace App\Filament\Resources\Mutasis;

use App\Filament\Resources\Mutasis\Pages\CreateMutasi;
use App\Filament\Resources\Mutasis\Pages\EditMutasi;
use App\Filament\Resources\Mutasis\Pages\ListMutasis;
use App\Filament\Resources\Mutasis\Pages\ViewMutasi;
use App\Filament\Resources\Mutasis\Schemas\MutasiForm;
use App\Filament\Resources\Mutasis\Schemas\MutasiInfolist;
use App\Filament\Resources\Mutasis\Tables\MutasisTable;
use App\Models\Mutasi;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MutasiResource extends Resource
{
    protected static ?string $model = Mutasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Inventaris Alat';
    protected static ?string $modelLabel = 'Mutasi Alat';
  protected static ?string $pluralModelLabel = 'Mutasi Alat';

    public static function form(Schema $schema): Schema
    {
        return MutasiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MutasiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MutasisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMutasis::route('/'),
            'create' => CreateMutasi::route('/create'),
            'view' => ViewMutasi::route('/{record}'),
            'edit' => EditMutasi::route('/{record}/edit'),
        ];
    }
}
