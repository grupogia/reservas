<?php

namespace Tests\Feature;

use App\Suite;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class createReservationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function create_reservation()
    {
        $this->seed();
        $uri = '/reservaciones';
        $user = User::where('email', '=', 'desarrollo@lasmananitas.com.mx')->first();
        $user->assignRoles('admin');
        $options = [
            'tarifa'   => 'rack',
            'bed_type' => 'queen',
            'adultos'  => 2,
            'ninios'   => 2,
        ];
        $body = [
            'nombre'           => $this->faker->firstName,
            'apellidos'        => $this->faker->lastName,
            'email'            => $this->faker->email,
            'telefono'         => $this->faker->numerify('##########'),
            'direccion'        => $this->faker->address,
            'procedencia'      => $this->faker->city,
            'monto'            => 4000,
            'fecha_de_entrada' => '03/10/2019',
            'fecha_de_salida'  => '07/10/2019',
            'hora_de_entrada'  => '10:30 AM',
            'hora_de_salida'   => '03:20 PM',
            'tipo_pago'        => 'efectivo',
            'tipo_de_segmentacion' => 'directa',
        ];

        Cart::add(Suite::first()->id, '2 TULIPAN', 1, 1700, 0, $options);

        $response = $this->actingAs($user)->json('post', $uri, $body);
        //$response->dump();
        $response->assertStatus(200)
        ->assertJson([
            'success' => 'Reservación correcta',
            'price' => 6800.00
        ]);
    }
}
