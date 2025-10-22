<?php

namespace App\Filament\Resources\NomorSurats\Pages;

use App\Models\NomorSurat;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\NomorSurats\NomorSuratResource;

class ListNomorSurats extends ListRecords
{
    protected static string $resource = NomorSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Nomor Baru'),
        ];
    }
}
