<?php

namespace Database\Seeders;

use App\Models\Config\UnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitType::firstOrCreate([
            'name' => 'Mass'
        ]);
        UnitType::firstOrCreate([
            'name' => "Volume"
        ]);
        UnitType::firstOrCreate([
            'name' => "Length"
        ]);
        //
    }
}