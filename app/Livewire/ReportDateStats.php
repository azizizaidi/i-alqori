<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ReportClass;
use Carbon\Carbon;

class ReportDateStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Sum the allowance_amount for the specified month
        $earlyAllowance = ReportClass::where('month', '11-2025')
            ->where('created_at', '<', Carbon::create(2025, 12, 1))
            ->sum('allowance');

        $lateAllowance = ReportClass::where('month', '11-2025')
            ->where('created_at', '>=', Carbon::create(2025, 12, 1))
            ->sum('allowance');

            //total allowance current month where status is paid
            $paidAllowance = ReportClass::where('month', '11-2025')
            ->where('allowance_note','like','dah_bayar')
            ->sum('allowance');
           
            //total allowance balance where status not paid
            $unpaidAllowance = ReportClass::where('month', '11-2025')
            ->where('allowance_note','not like', 'dah_bayar')
            ->sum('allowance');
     

        return [
            Stat::make('Jumlah Elaun Hantar Sebelum 1/12/25', 'RM' . number_format($earlyAllowance, 2))
                ->color('success')
                ->extraAttributes([
                    // Add attributes if needed
                ]),
            Stat::make('Jumlah Elaun Hantar Lambat', 'RM' . number_format($lateAllowance, 2))
                ->extraAttributes([
                    // Add attributes if needed
                ]),

                //stat make total allowance current month where status is paid
            Stat::make('Jumlah Elaun Belum Bayar', 'RM' . number_format($unpaidAllowance, 2))
                ->extraAttributes([
                    // Add attributes if needed
                ]),
          
        
        ];
    }
}
