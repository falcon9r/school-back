<?php

namespace App\Console\Commands;

use App\Models\Quarter;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class QuarterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quarters:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = DB::table('years')->orderByDesc('id')->first();
        $quarters = [
            [
                'year_id' => $year->id,
                'start' => $year->start,
                'place_id' => 1,
                'end' => Carbon::create()->year($year->start)->month(Carbon::NOVEMBER)->days(11)->subDays(12)->format("Y-m-d")
            ],
            [
                'year_id' => $year->id,
                'start' => Carbon::create()->year($year->start)->month(Carbon::NOVEMBER)->days(11)->format("Y-m-d"),
                'place_id' => 2,
                'end' => Carbon::create()->year(Carbon::now()->addYear()->year)->month(Carbon::JANUARY)->days(11)->subDays(12)->format("Y-m-d")
            ],
            [
                'year_id' => $year->id,
                'start' => Carbon::create()->year(Carbon::now()->addYear()->year)->month(Carbon::JANUARY)->days(11)->format("Y-m-d"),
                'place_id' => 3,
                'end' => Carbon::create()->year(Carbon::now()->addYear()->year)->month(Carbon::APRIL)->days(11)->subDays(12)->format("Y-m-d")
            ],
            [
                'year_id' => $year->id,
                'start' => Carbon::create()->year(Carbon::now()->addYear()->year)->month(Carbon::APRIL)->days(1)->format("Y-m-d"),
                'place_id' => 4,
                'end' => Carbon::create()->year(Carbon::now()->addYear()->year)->month(Carbon::APRIL)->days(1)->addMonth(2)->format("Y-m-d")
            ]
        ];

        Quarter::truncate();
        foreach($quarters as $quarter){
            Quarter::create($quarter);
        }
        return Command::SUCCESS;
    }
}
