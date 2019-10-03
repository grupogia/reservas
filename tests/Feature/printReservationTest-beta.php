<?php

namespace Tests\Feature;

use App\Reservation;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class printReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Usuario no autenticado no debería ver las impresiones.
     *
     * @test
     * @return void
     */
    public function print_reservation_no_auth()
    {
        $this->seed();
        $reservation = Reservation::where('title', '=', 'Reservacion')->first();

        $response = $this->json('get', '/imprimir-reservacion/' . $reservation->id);
        $response->assertStatus(401);
    }

    /**
     * Un usuario autenticado si debería poder imprimir una reservación.
     *
     * @test
     * @return void
     */
    public function print_reservation_auth()
    {
        $this->seed();
        $reservation = Reservation::where('title', '=', 'Reservacion')->first();
        $user        = User::where('email', '=', 'desarrollo@lasmananitas.com.mx')->first();

        $response = $this->actingAs($user)->json('get', '/imprimir-reservacion/' . $reservation->id);
        $response->assertStatus(200);
    }
}
