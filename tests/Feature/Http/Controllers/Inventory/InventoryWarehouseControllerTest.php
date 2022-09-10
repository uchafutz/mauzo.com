<?php

namespace Tests\Feature\Http\Controllers\Inventory;

use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryWarehouseControllerTest extends TestCase
{
    use RefreshDatabase;
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

    /** @test */
    public function it_can_store_data_via_web() {
        //when
        $this->makeUserAndSignIn();
        $payload = [
            "name" => "Warehouse",
        ];

        //do
        $response = $this->post(route("inventory.inventoryWarehouses.store"), $payload);

        //assert
        $this->assertDatabaseHas("inventory_warehouses", $payload);
        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect();
    }

    /** @test */
    public function it_can_update_data_via_web() {
        //when
        $this->makeUserAndSignIn();
        $warehouse = $this->createInventoryWarehouse();
        $payload = [
            "name" => "Warehouse (edited)",
        ];

        //do
        $response = $this->patch(route("inventory.inventoryWarehouses.update", ["inventoryWarehouse" => $warehouse]), $payload);

        //assert
        $this->assertDatabaseHas("inventory_warehouses", $payload);
        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect();
    }

     /** @test */
     public function it_can_delete_data_via_web() {
        //when
        $this->makeUserAndSignIn();
        $warehouse = $this->createInventoryWarehouse();

        //do
        $response = $this->delete(route("inventory.inventoryWarehouses.update", ["inventoryWarehouse" => $warehouse]));

        //assert
        $this->assertSoftDeleted($warehouse);
        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect();
    }

    /** @test */
    public function it_can_get_data_via_api() {
        //when
        $this->makeUserAndSignInApi();
        $warehouse = $this->createInventoryWarehouse();

        //do
        $response = $this->getJson(route("api.inventory.inventoryWarehouses.index"));

        //assert
        // $response->dump();
        $this->assertTrue(count($response["data"]) > 0);
        $response
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_store_data_via_api() {
        //when
        $this->makeUserAndSignInApi();
        $payload = [
            "name" => "Warehouse",
        ];

        //do
        $response = $this->postJson(route("api.inventory.inventoryWarehouses.store"), $payload);

        //assert
        $this->assertDatabaseHas("inventory_warehouses", $payload);
        $response
            ->assertJson(["data" => $payload])
            ->assertStatus(201);
    }

    /** @test */
    public function it_can_update_data_via_api() {
        //when
        $this->makeUserAndSignInApi();
        $warehouse = $this->createInventoryWarehouse();
        $payload = [
            "name" => "Warehouse (edited)",
        ];

        //do
        $response = $this->patchJson(route("api.inventory.inventoryWarehouses.update", ["inventoryWarehouse" => $warehouse]), $payload);

        //assert
        $this->assertDatabaseHas("inventory_warehouses", $payload);
        $response
            ->assertJson(["data" => $payload])
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_show_data_via_api() {
        //when
        $this->makeUserAndSignInApi();
        $warehouse = $this->createInventoryWarehouse();

        //do
        $response = $this->getJson(route("api.inventory.inventoryWarehouses.show", ["inventoryWarehouse" => $warehouse]));

        //assert
        $response
            ->assertJson(["data" => $warehouse->toArray()])
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_data_via_api() {
        //when
        $this->makeUserAndSignIn();
        $warehouse = $this->createInventoryWarehouse();

        //do
        $response = $this->deleteJson(route("inventory.inventoryWarehouses.update", ["inventoryWarehouse" => $warehouse]));

        //assert
        $this->assertSoftDeleted($warehouse);
        $response
            ->assertStatus(204);
    }
}
