<?php

namespace Tests\Unit;

use App\Http\Controllers\PrintReservationController;
use App\Reservation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spipu\Html2Pdf\Html2Pdf;

class printReservationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function getPrint()
    {
        $printer = new PrintReservationController();
        $result = $printer(Reservation::first(), new Html2Pdf);

        $this->assertTrue(true);
    }
}
