<?php

namespace App\Console\Commands;

use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fines:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate daily fines for overdue borrowings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueBorrowings = Borrowing::where('status', 'borrowed')
            ->where('expected_return_date', '<', Carbon::today())
            ->get();

        foreach ($overdueBorrowings as $borrowing) {
            $daysOverdue = Carbon::today()->diffInDays(Carbon::parse($borrowing->expected_return_date));
            $dailyFine = 10000; // 10k per day
            $additionalFine = $daysOverdue * $dailyFine;

            // If fine_amount is null, set it; else add to existing
            $currentFine = $borrowing->fine_amount ?? 0;
            $borrowing->update(['fine_amount' => $currentFine + $additionalFine]);
        }

        $this->info('Fines calculated for ' . $overdueBorrowings->count() . ' overdue borrowings.');
    }
}
