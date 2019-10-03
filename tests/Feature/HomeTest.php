<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Usuario no autenticado
     *
     * @return void
     */
    public function unknownUserTest()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /**
     * Ingreso de usuario autenticado
     *
     * @test
     * @return void
     */
    public function authenticatedUserTest()
    {
        $this->seed();
        $response = $this->actingAs(User::first())
        ->get('/');

        $response->assertStatus(200);
    }
}
