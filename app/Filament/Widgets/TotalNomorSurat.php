<?php

namespace App\Filament\Widgets;

use App\Models\NomorSurat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TotalNomorSurat extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    public function getColumns(): int | array
    {
        return 1;
    }

    protected function getStats(): array
    {
        // $totalNomor = NomorSurat::select(DB::raw('SUM(
        //     CASE 
        //         WHEN nomor_end IS NOT NULL THEN (nomor_end - nomor_start + 1)
        //         ELSE 1
        //     END
        // ) as total'))
        // ->value('total') ?? 0;

        $totalNomor = NomorSurat::query()
            ->selectRaw('
                COALESCE(SUM(
                    CASE 
                        WHEN nomor_end IS NOT NULL THEN (nomor_end - nomor_start + 1)
                        ELSE 1
                    END
                ), 0) as total
            ')
            ->value('total');
        
        // return [
        //     Stat::make('Total Nomor Surat', $totalNomor)
        //         ->description('Total nomor surat yang sudah dibuat oleh semua user')
        //         ->color('primary'),
        // ];

        return [
            Stat::make('Total Nomor Surat', number_format($totalNomor))
                ->description('Total semua nomor surat yang telah dibuat')
                ->color('primary'),
        ];
    }
}
