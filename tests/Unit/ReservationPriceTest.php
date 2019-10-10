<?php

namespace Tests\Unit;

use App\Http\Controllers\ReservationController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationPriceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Prueba que calcule correctamente los precios de la reservaciones
     *
     * @test
     * @return void
     */
    public function calculateReservationPrice()
    {
        $this->seed();
        $controller = new ReservationController;
        $tipo_pago  = 'efectivo';
        $canal      = 'otas';
        $noches     = 4;
        $success    = [ 'message' => '4 noches, no paga impuestos ni comisión', 'value' => '6,800.00' ];

        Cart::add('1', '2 TULIPAN', 1, 1700, 0);

        $result = $controller->getArrayTotalReservation($tipo_pago, $canal, $noches);
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
        $this->seed();
        $controller = new ReservationController;
        $tipo_pago  = 'tarjeta';
        $canal      = 'directas';
        $success    = [ 'message' => '1 noche, paga IVA 16%, HSH 3.75%', 'value' => '2,035.75' ];

        Cart::add('1', '2 TULIPAN', 1, 1700, 0);

        $result = $controller->getArrayTotalReservation($tipo_pago, $canal);
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
        $this->seed();
        $controller = new ReservationController;
        $tipo_pago  = 'tarjeta';
        $canal      = 'otas';
        $success    = [ 'message' => '1 noche, paga IVA 16%, HSH 3.75% y 20% comisión por OTAs', 'value' => '2,375.75' ];

        Cart::add('1', '2 TULIPAN', 1, 1700, 0);

        $result = $controller->getArrayTotalReservation($tipo_pago, $canal);
        $this->assertEquals($result, $success);
    }
}
