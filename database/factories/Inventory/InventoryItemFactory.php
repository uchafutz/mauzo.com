<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\InventoryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory

{

    protected $model = InventoryItem::class;
    /**
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'inventory_category_id' => $this->faker->numberBetween(1, 1),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'unit_type_id' => $this->faker->numberBetween(1, 1),
            'is_manufactured' => $this->faker->numberBetween(1, 0),
            'is_product' => $this->faker->numberBetween(0, 1),
            'is_material' => $this->faker->numberBetween(0, 1),
            'default_unit_id' => $this->faker->numberBetween(1, 1),
            //
        ];
    }
}