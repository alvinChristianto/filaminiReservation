<?php

namespace App\Filament\Widgets;

use App\Models\Pengajuan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PengajuanStatusOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $showAll = [1];
        $ids = auth()->id();

        if (!in_array($ids, $showAll)) {
            return [
                Stat::make('DIAJUKAN', Pengajuan::query()
                                        ->where('status_pengajuan', 'DIAJUKAN')
                                        ->where('user_id', $ids)->count())
                ->description('pengajuan yang sudah diajukan tapi belum dicek')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),  
                Stat::make('DISETUJUI', Pengajuan::query()
                                        ->where('status_pengajuan', 'DISETUJUI')
                                        ->where('user_id', $ids)->count())
                ->description('pengajuan yang disetujui untuk dibelanjakan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
                Stat::make('DITOLAK', Pengajuan::query()
                                        ->where('status_pengajuan', 'DITOLAK')
                                        ->where('user_id', $ids)->count())
                ->description('pengajuan yang diajukan tetapi ditolak')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
                Stat::make('SELESAI', Pengajuan::query()
                                        ->where('status_pengajuan', 'SELESAI')
                                        ->where('user_id', $ids)->count())
                ->description('pengajuan yang diajukan, disetujui dan diselesaikan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            ];
        }
        else{
            return [
                Stat::make('DIAJUKAN', Pengajuan::query()->where('status_pengajuan', 'DIAJUKAN')->count())
                ->description('pengajuan yang sudah diajukan tapi belum dicek')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),  
                Stat::make('DISETUJUI', Pengajuan::query()->where('status_pengajuan', 'DISETUJUI')->count())
                ->description('pengajuan yang disetujui untuk dibelanjakan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
                Stat::make('DITOLAK', Pengajuan::query()->where('status_pengajuan', 'DITOLAK')->count())
                ->description('pengajuan yang diajukan tetapi ditolak')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
                Stat::make('SELESAI', Pengajuan::query()->where('status_pengajuan', 'SELESAI')->count())
                ->description('pengajuan yang diajukan, disetujui dan diselesaikan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            ];
        }

        
    }
}
