<?php

namespace Tests\Feature\Http\Controllers\Config;

use App\Models\Config\UnitType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function it_can_create_a_unit()
    {
        // when
        $user = User::factory()->create();
        $this->actingAs($user);
        $unitType = UnitType::create(['name' => "Mass"]);

        // do
        $response = $this->post(route('config.units.index'), [
            'name' => "Killogram",
            "description" => "Sample Description",
            "code" => "code",
            "unit_types" => $unitType->id,
        ]);

        // assert
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_a_unit()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
