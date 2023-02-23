<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisualizationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visualizations')->insert([
            'month' => 1,
            'month_name' => "Janeiro",
            'year' => 2022,
            'views' => 0,
        ]);
    }
}
