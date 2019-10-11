<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\Http\Requests\ChangePaymentReservation;
use App\Reservation;
use Illuminate\Http\Request;

class ChangePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la vista para cambiar el método de pago
     * 
     * @param \App\Reservation
     */
    public function index(Reservation $reservation)
    {
        return view('reservaciones.cambiar-metodo-pago', compact('reservation'));
    }

    /**
     * Actualiza el método de pago de una reservación
     * 
     * @param \App\Http\Requests\ChangePaymentReservation
     * @param \App\Reservation
     */
    public function update(ChangePaymentReservation $request, Reservation $reservation)
    {
        $data = $request->validated();
        $channel = $reservation->segmentation()->channel;

        if ($data['tipo_pago'] == 'tarjeta') {
            $card_id = $this->getCardId($data['numero_tarjeta'], $data, $reservation->client_id);

            $reservation->credit_card_id = $card_id;
        }

        $total = $this->getOldTotal($reservation);

        // Actualizar el total de la reservación tras el cambio del método de pago
        $new_total = $this->getArrayTotalReservation($reservation->payment_method, $channel, $total);

        $reservation->payment_method = $data['tipo_pago'];
        $reservation->save();

        return redirect()->back()->with('success', 'Método de pago actualizado');
    }

    /**
     * Obtiene el id de una tarjeta de crédito
     */
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

    /**
     * Devuelve un array con el total de una reservación
     * dependiendo el método de pago y el canal de segmentación
     * 
     * @var string $payment_method, $sementation_channel
     * @return array
     */
    public function getArrayTotalReservation($payment_method, $sementation_channel, $total)
    {
        // Inicializa variables básicas
        $total_with_iva = $total * env('CART_TAX', 21);
        $other_taxes    = $total * $this->impuesto_sobre_hospedaje;
        $commissions    = $total * $this->comision_por_otas;

        $msg = 'No paga impuestos ni comisión';

        // Valida si el tipo de págo es depósito o tarjeta
        if ($this->loadTax($payment_method)) {

            // Total mas impuestos
            $total = $total_with_iva + $other_taxes;
            $msg  = 'Paga IVA 16%, HSH 3.75%';

            if ($this->loadCommission($sementation_channel)) {

                // Total mas impuestos mas comisión
                $total = $total + $commissions;
                $msg  .= ' y 20% comisión por OTAs';
            }
        }
        return [ 'message' => $msg, 'value' => number_format($total, 2) ];
    }

    public function getOldTotal($reservation)
    {
        $details = $reservation->details();
        $subtotal = 0;

        foreach ($details as $detail) {
            $subtotal += $detail->subtotal;
        }
        return $subtotal;
    }

    /**
     * Varifica si se debe cargar impuestos
     * 
     * @var string $payment_method
     * @return boolean
     */
    private function loadTax($payment_method)
    {
        if ($payment_method == 'deposito' || $payment_method == 'tarjeta')
        return true;
        else return false;
    }

    /**
     * Verifica si se debe cargar comisiones
     * 
     * @var string $channel
     * @return boolean
     */
    private function loadCommission($channel)
    {
        if ($channel == 'otas')
        return true;
        else return false;
    }
}
