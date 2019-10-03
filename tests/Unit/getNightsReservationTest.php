<?php

namespace Tests\Unit;

use App\Http\Controllers\ReservationController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class getNightsReservationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function get_reservation_nights()
    {
        $controller = new ReservationController;
        $start = '03/10/2019';
        $end   = '07/10/2019';
        $expected = 4;

        $nights = $controller->getNights($start, $end);
        
        $this->assertIsInt($nights);
        $this->assertEquals($expected, $nights);
    }
}
