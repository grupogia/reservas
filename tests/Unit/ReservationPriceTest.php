<?php

namespace Tests\Unit;

use App\Http\Controllers\ReservationController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationPriceTest extends TestCase
{
    /**
     * Prueba que calcule correctamente los precios de la reservaciones
     *
     * @test
     * @return void
     */
    public function calculateReservationPrice()
    {
        $controller = new ReservationController;
        $success    = [ 'message' => 'No paga impuestos ni comisión', 'value' => '1,700.00' ];

        Cart::add('1', '2 TULIPAN', 1, 1700, 0);

        $result = $controller->getArrayTotalReservation('efectivo', 'otas');

        $this->assertEquals($result, $success);
    }

    /**
     * Prueba que calcule correctamente los precios de la reservaciones
     *
     * @test
     * @return void
     */
    public function calculateReservationPriceWithTaxes()
    {
        $controller = new ReservationController;
        $success    = [ 'message' => 'Paga IVA 16%, HSH 3.75%', 'value' => '2,035.75' ];

        Cart::add('1', '2 TULIPAN', 1, 1700, 0);

        $result = $controller->getArrayTotalReservation('tarjeta', 'directas');

        $this->assertEquals($result, $success);
    }

    /**
     * Prueba que calcule correctamente los precios de la reservaciones
     *
     * @test
     * @return void
     */
    public function calculateReservationPriceWithTaxesAndComissions()
    {
        $controller = new ReservationController;
        $success    = [ 'message' => 'Paga IVA 16%, HSH 3.75% y 20% comisión por OTAs', 'value' => '2,375.75' ];

        Cart::add('1', '2 TULIPAN', 1, 1700, 0);

        $result = $controller->getArrayTotalReservation('tarjeta', 'otas');

        $this->assertEquals($result, $success);
    }
}
