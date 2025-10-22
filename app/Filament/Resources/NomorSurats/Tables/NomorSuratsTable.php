<?php

namespace App\Filament\Resources\NomorSurats\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class NomorSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('tanggal')
                    ->date()
                    ->searchable(),

                TextColumn::make('jenisNomor.jenis_nomor')
                    ->searchable(),

                TextColumn::make('nomor_start')
                    ->label('Nomor Surat')
                    ->searchable(),

                // TextColumn::make('nomor_end')
                //     ->label('Nomor Akhir')
                //     ->sortable(),

                TextColumn::make('kodefikasi_surat')
                    ->label('Kodefikasi Surat')
                    ->searchable(),

                TextColumn::make('perihal_surat')
                    ->label('Perihal Surat')
                    ->searchable(),

                TextColumn::make('tujuan_surat')
                    ->label('Tujuan Surat')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Export Data')
                    ->fileName('nomor-surat')
                    ->timeFormat('d-m-Y')
                    // ->formats(['xlsx', 'csv'])
                    ->color('blue')
                    ->icon('heroicon-o-arrow-down-tray'),
            ])

            ->filters([
                SelectFilter::make('jenis_nomor_id')
                    ->label('Jenis Nomor Surat')
                    ->relationship('jenisNomor', 'jenis_nomor'),
                ])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                        ->label('Export Terpilih')
                        ->fileName('nomor-surat-terpilih')
                        ->color('primary')
                        // ->formats(['xlsx', 'csv'])
                        ->icon('heroicon-o-arrow-down-tray'),
                ]),
            ]);
    }
}
