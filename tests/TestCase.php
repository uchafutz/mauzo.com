<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $user;

    protected function setUp(): void {
        parent::setUp();
    }

    public function makeUserAndSignIn() {
        $user = User::factory()->create();
        $this->user = $user;
        $this->actingAs($user);
        return $this;
    }

    public function makeUserAndSignInApi() {
        $user = User::factory()->create();
        $this->user = $user;
        $token = $user->createToken("token");
        $this->withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token->plainTextToken,
        ]);
        return $this;
    }
}
