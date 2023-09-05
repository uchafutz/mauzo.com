<?php

namespace Database\Seeders;

use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryWarehouse::factory(3)->create();
    }
}
