<?php

namespace App\Filament\Resources\NomorSurats;

use App\Filament\Resources\NomorSurats\Pages\CreateNomorSurat;
use App\Filament\Resources\NomorSurats\Pages\EditNomorSurat;
use App\Filament\Resources\NomorSurats\Pages\ListNomorSurats;
use App\Filament\Resources\NomorSurats\Schemas\NomorSuratForm;
use App\Filament\Resources\NomorSurats\Tables\NomorSuratsTable;
use App\Models\NomorSurat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NomorSuratResource extends Resource
{
    protected static ?string $model = NomorSurat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentPlus;

    protected static string | UnitEnum | null $navigationGroup = 'Nomor Surat Management';

    protected static ?string $navigationLabel = 'Pembuatan Nomor';

    protected static ?string $modelLabel = 'Nomor Surat';

    protected static ?string $pluralModelLabel = 'Nomor Surat';

    // protected static ?string $recordTitleAttribute = 'Buat Nomor';

    // public static function getNavigationUrl(): string
    // {
    //     return static::getUrl('create'); 
    // }

    public static function form(Schema $schema): Schema
    {
        return NomorSuratForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NomorSuratsTable::configure($table);
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
            'index' => ListNomorSurats::route('/'),
            'create' => CreateNomorSurat::route('/create'),
            'edit' => EditNomorSurat::route('/{record}/edit'),
        ];
    }
}
