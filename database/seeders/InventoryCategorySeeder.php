<?php

namespace Database\Seeders;

use App\Models\Inventory\InventoryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        InventoryCategory::firstOrCreate([
            "name" => "Material"
        ]);
        InventoryCategory::firstOrCreate([
            "name" => "Nafaka"
        ]);
    }
}