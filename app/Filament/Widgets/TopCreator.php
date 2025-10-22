<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\NomorSurat;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TopCreator extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 2;

    public function getColumns(): int | array
    {
        return 1;
    }

    protected function getStats(): array
    {
        // $top = NomorSurat::select('user_id', DB::raw('SUM(nomor_end - nomor_start + 1) as total_surat'))

        // $top = NomorSurat::select('user_id', DB::raw('SUM(COALESCE(nomor_end, nomor_start) - nomor_start + 1) as total_surat'))
        //     ->groupBy('user_id')
        //     ->orderByDesc('total_surat')
        //     ->first();

        $top = NomorSurat::query()
            ->join('users', 'nomor_surats.user_id', '=', 'users.id')
            ->select(
                'users.name as user_name',
                DB::raw('SUM(COALESCE(nomor_end, nomor_start) - nomor_start + 1) as total_surat')
            )
            ->groupBy('users.name')
            ->orderByDesc('total_surat')
            ->first();

        if (! $top) {
            return [
                Stat::make('Pembuat Surat Terbanyak', 'Belum ada data'),
            ];
        }

        $user = User::find($top->user_id);

        // return [
        //     Stat::make('Pembuat Surat Terbanyak', $user->name)
        //         ->description("Total surat yang sudah dibuat: {$top->total_surat}")
        //         ->color('primary'),
        // ];

        return [
            Stat::make('Pembuat Surat Terbanyak', $top->user_name)
                ->description("Total surat yang sudah dibuat: {$top->total_surat}")
                ->color('primary'),
        ];
    }
}
