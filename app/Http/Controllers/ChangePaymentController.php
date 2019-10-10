<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\Reservation;
use Illuminate\Http\Request;

class ChangePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Reservation $reservation)
    {
        return view('reservaciones.cambiar-metodo-pago', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'tipo_pago'        => 'required|string',
            'numero_tarjeta'   => 'required_if:tipo_pago,==,tarjeta|nullable|digits_between:15,16',
            'vencimiento'      => 'required_if:tipo_pago,==,tarjeta|nullable|max:5',
            'codigo_seguridad' => 'required_if:tipo_pago,==,tarjeta|nullable|digits_between:3,4',
            'titular'          => 'required_if:tipo_pago,==,tarjeta|nullable|min:4',
        ]);

        $data = $request->all();

        if ($data['tipo_pago'] == 'tarjeta') {
            $card_id = $this->getCardId($data['numero_tarjeta'], $data, $reservation->client_id);

            $reservation->credit_card_id = $card_id;
        }

        $reservation->payment_method = $data['tipo_pago'];
        $reservation->save();

        return redirect()->back()->with('success', 'Método de pago actualizado');
    }

    public function getCardId($number, $data, $client_id)
    {
        $cards = CreditCard::where('number', '=', $number)->get();

        if (count($cards) <= 0)
        $card = $this->insertCreditCard($data, $client_id);
        else
        $card = $cards->firts();

        return $card->id;
    }

    /**
     * Registra una tarjeta de crédito en base a un cliente
     */
    private function insertCreditCard($data, $client_id)
    {
        $creditCard = new CreditCard();
        $creditCard->client_id     = $client_id;
        $creditCard->number        = $data['numero_tarjeta'];
        $creditCard->expiration    = $data['vencimiento'];
        $creditCard->security_code = $data['codigo_seguridad'];
        $creditCard->holder        = $data['titular'];
        $creditCard->save();

        return $creditCard;
    }
}
