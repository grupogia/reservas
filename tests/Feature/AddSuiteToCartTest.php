<?php

namespace Tests\Feature;

use App\Suite;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddSuiteToCartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function add_suite()
    {
        $this->seed();
        $user  = User::where('email', '=', 'desarrollo@lasmananitas.com.mx')->first();
        $user->assignRoles('admin');
        $suite = Suite::first();
        $body  = [
            'habitacion' => 1,
            'tarifa' => 'rack',
            'adultos' => 2,
            'ninios' => 0,
        ];

        $response = $this->actingAs($user)->json('post', '/carrito-habitaciones/' . $suite->id, $body);
        //$response->dump();
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Habitación asignada',
            'price' => '2,340.00',
        ]);
    }

    /**
     * Debería calcular el precio más el costo de las personas extra.
     *
     * @test
     * @return void
     */
    public function add_suite_with_extra_person()
    {
        $this->seed();
        $user  = User::where('email', '=', 'desarrollo@lasmananitas.com.mx')->first();
        $user->assignRoles('admin');
        $suite = Suite::first();
        $body  = [
            'habitacion' => 1,
            'tarifa' => 'rack',
            'adultos' => 3,
            'ninios' => 0,
        ];

        $response = $this->actingAs($user)->json('post', '/carrito-habitaciones/' . $suite->id, $body);
        // $response->dump();
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Habitación asignada',
            'price' => '3,040.00',
        ]);
    }
}
