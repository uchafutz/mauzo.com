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
}
