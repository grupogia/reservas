<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReservationDetail;
use App\Rate;
use App\Suite;
use App\Reservation;
use App\ReservationDetail;

class ReservationDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(ReservationDetail $detail)
    {
        $suites = Suite::all();
        $rates = [
            ['type' => 'rack'],
            ['type' => 'bar 1'],
            ['type' => 'bar 2'],
            ['type' => 'grupal'],
        ];
        return view('detalle-reservacion.edit', compact('detail', 'suites', 'rates'));
    }

    /**
     * Actualiza la habitación de una reservación
     * 
     * @param \App\Http\Requests\UpdateReservationDetail
     * @param \App\ReservationDetail
     */
    public function update(UpdateReservationDetail $request, ReservationDetail $detail)
    {
        $data = $request->validated();

        $rate = Rate::where('suite_id', '=', $data['habitacion'])->where('type', $data['tarifa'])->first();

        $detail->suite_id = $data['habitacion'];
        $detail->rate_type = $data['tarifa'];
        $detail->adults = $data['adultos'];
        $detail->children = $data['ninios'];
        $detail->subtotal = $rate->price;
        $detail->save();

        $reservation = $detail->reservation;
        $segmentation = $reservation->segmentation;

        $total = $this->calculateTotal($reservation);
        $nights = $this->getNights(explode(' ', $reservation->checkin)[0], explode(' ', $reservation->checkout)[0]);

        $array_total = $this->getArrayTotalReservation($reservation->payment_method, $segmentation->channel, $total, $nights);

        return redirect()->back()->with('success', 'Se acutualizó la reservción, el nuevo total es: $ ' . $array_total['value']);
    }

     /**
     * Devuelve un array con el total de una reservación
     * dependiendo el método de pago y el canal de segmentación
     * 
     * @param string $payment_method, $sementation_channel
     * @return array
     */
    public function getArrayTotalReservation(string $payment_method, string $sementation_channel, $total, $night = 1)
    {
        // Inicializa variables básicas
        $total_with_iva = $total * ((env('CART_TAX', 21) / 100) + 1);
        $other_taxes    = $total * (env('ISH', 3.75) / 100);
        $commissions    = $total * (env('COMISION_OTAS', 20) / 100);

        $msg = 'No paga impuestos ni comisión';

        // Valida si el tipo de págo es depósito o tarjeta
        if ($this->loadTax($payment_method)) {

            // Total mas impuestos
            $total = $total_with_iva + $other_taxes;
            $msg   = 'Paga IVA 16%, ISH 3.75%';

            if ($this->loadCommission($sementation_channel)) {

                // Total mas impuestos mas comisión
                $total = $total + $commissions;
                $msg  .= ' y 20% comisión por OTAs';
            }
        }
        $total = $total * $night;
        return [ 'message' => $msg, 'value' => number_format($total, 2) ];
    }

    /**
     * Devuelve el total de sumar todos los conceptos de una reservación
     * 
     * @param \App\Reservation $reservation
     */
    public function calculateTotal(Reservation $reservation)
    {
        $details = $reservation->details;
        $subtotal = 0;

        foreach ($details as $detail) {
            $subtotal += $detail->subtotal;
        }
        return $subtotal;
    }

    /**
     * Varifica si se debe cargar impuestos
     * 
     * @param string $payment_method
     * @return boolean
     */
    private function loadTax(string $payment_method)
    {
        if ($payment_method == 'deposito' || $payment_method == 'tarjeta')
        return true;
        else return false;
    }

    /**
     * Verifica si se debe cargar comisiones
     * 
     * @param string $channel
     * @return boolean
     */
    private function loadCommission(string $channel)
    {
        if ($channel == 'otas')
        return true;
        else return false;
    }

    /**
     * Obtiene el número de noches dependiendo de un rango de fechas.
     * 
     * @param string $start d/m/Y
     * @param string $end  d/m/Y
     */
    public function getNights(string $start, string $end)
    {
        $start_date = date_create_from_format('d/m/Y', $start);
        $end_date   = date_create_from_format('d/m/Y', $end);
        
        $nights = $start_date->diff($end_date)->d;
        return $nights;
    }
}
