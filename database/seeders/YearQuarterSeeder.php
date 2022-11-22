<?php

namespace Database\Seeders;

use App\Models\Quarter;
use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class YearQuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Year::truncate();
        Quarter::truncate();
        Artisan::call('year:create');
        Artisan::call('quarters:create');
    }
}
