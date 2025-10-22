<?php

namespace App\Filament\Resources\NomorSurats\Schemas;

use App\Models\NomorSurat;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class NomorSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nama')
                    ->default(fn () => Auth::id())
                    ->disabled()
                    ->relationship('user', 'name')
                    ->columnSpanFull()
                    ->required(),

                DatePicker::make('tanggal')
                    ->columnSpanFull()  
                    ->required(),

                Select::make('jenis_nomor_id')
                    ->label('Jenis Nomor Surat')
                    ->columnSpanFull()
                    ->relationship('jenisNomor', 'jenis_nomor')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (! $state) return;

                        $maxStart = NomorSurat::where('jenis_nomor_id', $state)->max('nomor_start');
                        $maxEnd   = NomorSurat::where('jenis_nomor_id', $state)->max('nomor_end');

                        $lastNumber = max($maxStart ?? 0, $maxEnd ?? 0);
                        $nextNumber = $lastNumber + 1;

                        $set('nomor_start', $nextNumber);
                    })
                    ->required(),

                TextInput::make('nomor_start')
                    ->label('Nomor Surat')
                    ->readOnly()
                    ->dehydrated(true)
                    ->columnSpanFull()
                    ->required(),

                // TextInput::make('nomor_end')
                //     ->label('Nomor Berikutnya')
                //     ->placeholder('Silahkan isi jika nomor yang dibutuhkan lebih dari satu')
                //     ->numeric()
                //     ->default(null),

                TextInput::make('kodefikasi_surat')
                    ->label('Kodefikasi Surat')
                    ->placeholder('Contoh : UN40.A6/KM.05.00/2025')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('perihal_surat')
                    ->label('Perihal Surat')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('tujuan_surat')
                    ->label('Tujuan Surat')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
