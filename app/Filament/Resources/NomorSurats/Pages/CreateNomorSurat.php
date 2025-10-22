<?php

namespace App\Filament\Resources\NomorSurats\Pages;

use App\Models\NomorSurat;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\NomorSurats\NomorSuratResource;

class CreateNomorSurat extends CreateRecord
{
    protected static ?string $title = 'Buat Nomor Surat';

    protected static string $resource = NomorSuratResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function canCreateAnother(): bool
    {
        return true;
    }

    protected function beforeCreate(): void
    {
        $exists = NomorSurat::where('jenis_nomor_id', $this->data['jenis_nomor_id'])
            ->where('nomor_start', $this->data['nomor_start'])
            ->exists();

        if ($exists) {
            Notification::make()
                ->title('Nomor tersebut sudah ada')
                ->body('Silakan refresh halaman terlebih dahulu untuk mendapatkan nomor baru.')
                ->danger()
                ->persistent() // <- Supaya tidak hilang otomatis
                ->duration(0)
                ->send();

            $this->halt();
        }
        
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        $nomorStart = $this->record->nomor_start;
        $nomorEnd = $this->record->nomor_end ?? null;

        if ($nomorEnd && $nomorEnd != $nomorStart) {
            $nomorText = "{$nomorStart} s/d {$nomorEnd}";
        } else {
            $nomorText = $nomorStart;
        }

        return Notification::make()
            ->title('Berhasil!')
            ->body("Anda berhasil membuat nomor surat baru dengan nomor: <strong>{$nomorText}</strong>")
            ->success()
            ->seconds(10);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan'),
            $this->getCreateAnotherFormAction()
                ->label('Simpan & Buat Kembali'),
            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }
}
