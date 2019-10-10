<?php

namespace Tests\Unit;

use App\Client;
use App\Http\Controllers\ChangePaymentController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetCardIdTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function get_card_id()
    {
        $this->seed();
        $controller = new ChangePaymentController();
        $client = Client::first();
        $data = [
            'tipo_pago'        => 'tarjeta',
            'numero_tarjeta'   => '123455668345678',
            'vencimiento'      => '12/21',
            'codigo_seguridad' => '123',
            'titular'          => 'Mismo',
        ];

        $card_id = $controller->getCardId($data['numero_tarjeta'], $data, $client->id);
        //dump($card_id);
        $this->assertTrue(is_integer($card_id));
    }
}
