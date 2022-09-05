<?php

namespace Tests\Feature\Http\Controllers\Inventory;

use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryWarehouseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public static function createInventoryWarehouse() {
        $inventoryWarehouse = InventoryWarehouse::create([
            "name" => "Warehouse",
        ]);
        return $inventoryWarehouse;
    }

    /** @test */
    public function it_can_view_the_index_page()
    {
        // When
        $this->makeUserAndSignIn();

        $response = $this->get(route("inventory.inventoryWarehouses.index"));

        $response->assertViewIs("resources.inventory.warehouses.index");
    }

    /** @test */
    public function it_can_view_the_create_page()
    {
        // When
        $this->makeUserAndSignIn();

        $response = $this->get(route("inventory.inventoryWarehouses.create"));

        $response->assertViewIs("resources.inventory.warehouses.form");
    }

    /** @test */
    public function it_can_view_the_edit_page()
    {
        // When
        $this->makeUserAndSignIn();
        $warehouse = self::createInventoryWarehouse();

        $response = $this->get(route("inventory.inventoryWarehouses.edit", ["inventoryWarehouse" => $warehouse]));

        $response->assertViewIs("resources.inventory.warehouses.form");
    }
}
