<?php

namespace App\Console\Commands;

use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NewSchoolYearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'year:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command create new year for school';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = Carbon::now()->year;
        $name .= '/';
        $name .= Carbon::now()->addYear()->year;
        $start = Carbon::create()->year(Carbon::now()->year)->months(Carbon::SEPTEMBER)->format("Y-m-d");
        Year::query()->create([
            'name' => $name,
            'start' => $start
        ]);
        return Command::SUCCESS;
    }
}
