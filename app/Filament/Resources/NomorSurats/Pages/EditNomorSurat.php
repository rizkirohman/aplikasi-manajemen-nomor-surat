<?php

namespace App\Filament\Resources\NomorSurats\Pages;

use App\Filament\Resources\NomorSurats\NomorSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNomorSurat extends EditRecord
{
    protected static string $resource = NomorSuratResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
