<?php

namespace Database\Seeders;

use App\Models\Config\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::firstOrCreate([
            "key" => "CONFIG_VAT",
            "value" => 0.18
        ]);
        //
    }
}