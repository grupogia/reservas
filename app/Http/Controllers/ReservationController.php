<?php

namespace App\Http\Controllers;

use App\Client;
use App\CreditCard;
use App\Reservation;
use App\Segmentation;
use App\ReservationDetail;
use App\Http\Requests\CreateReservation;
use App\Http\Requests\UpdateReservation;
use App\Http\Requests\CalculateReservation;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class ReservationController extends Controller
{
    private $impuesto_sobre_hospedaje = 0.0375;
    private $comision_por_otas = 0.2;

    /**
     * Muestra todas las reservaciones registradas con sus habitaciones
     * para ser mostradas en el calendario
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = 'reservations';
        $columns = [
            'reservations.*',
            'reservation_details.suite_id as resourceId',
            'reservation_details.adults',
            'reservation_details.children',
            'clients.name',
            'clients.surname',
            'clients.email',
            'clients.phone',
            'clients.address',
            'clients.country',
            'credit_cards.number',
        ];

        if (!empty($_GET['start']) && !empty($_GET['end'])) {
            $reservations = DB::table($table)
            ->select($columns)
            ->join('clients', 'reservations.client_id', '=', 'clients.id')
            ->join('reservation_details', 'reservations.id', '=', 'reservation_details.reservation_id')
            ->leftjoin('credit_cards', 'reservations.credit_card_id', '=', 'credit_cards.id')
            ->whereBetween($table . '.start', [$_GET['start'], $_GET['end']])
            ->orWhereBetween($table . '.end', [$_GET['start'], $_GET['end']])
            ->get();
            
        } else {
            $reservations = DB::table($table)
            ->select($columns)
            ->join('clients', 'reservations.client_id', '=', 'clients.id')
            ->join('reservation_details', 'reservations.id', '=', 'reservation_details.reservation_id')
            ->get();
        }

        return response()->json($reservations);
    }

    /**
     * Crea una nueva reservación y la guarda en la base de datos.
     * Puede crear clientes, tarjetas de crédito y reservas con
     * sus detalles y datos de segmentación
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReservation $request)
    {
        // Inicializa variables básicas
        $arrTotal  = $this->getArrayTotalReservation($request->tipo_pago, $request->tipo);
        $is_client = $this->getClientsByEmail($request->email);
        $card_id   = null;

        $dates = $this->getArrayDates(
            $request->fecha_de_entrada, $request->fecha_de_salida,
            $request->hora_de_entrada, $request->hora_de_salida
        );
        
        // Valida si ya existe el cliente
        if (count($is_client)) {
            $client = Client::find($is_client[0]->id);

        } else {
            $client = $this->createClient($request);
        }

        // Registra la tarjeta de crédito
        if ($request->tipo_pago == 'tarjeta') {
            $credit_card = $this->insertCreditCard($request, $client->id);
            $card_id = $credit_card->id;
        }

        // Registra la reservación
        $reservation = new Reservation();
        $reservation->user_id   = auth()->user()->id;
        $reservation->client_id = $client->id;
        $reservation->credit_card_id = $card_id;
        $reservation->title     = 'Reservación';
        $reservation->folio     = time();
        $reservation->checkin   = $dates['checkin'];
        $reservation->checkout  = $dates['checkout'];
        $reservation->start     = $dates['start']->format('Y-m-d H:i:s');
        $reservation->end       = $dates['end']  ->format('Y-m-d H:i:s');
        $reservation->total     = str_replace(',', '', $arrTotal['value']);
        $reservation->payment_method = $request->tipo_pago;
        $reservation->save();

        // Registra datos de segmentación
        $this->insertSegmentation($request, $reservation->id);

        // Registra las habitaciones cargadas del carrito de compras
        $this->insertReservationDetails(Cart::content(), $reservation->id);

        // Vacía el carrito
        Cart::destroy();
        return response()->json(['success' => 'Reservación correcta']);
    }

    /**
     * Devuelve todas las reservaciones con sus detalles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);
        $initial = 0;
        $suites_array = [];

        foreach ($reservation->details as $detail) {
            $initial += $detail->subtotal;
            $suites_array[] = $detail->suite;
        }

        $data = [
            'reservation' => $reservation,
            'detalle' => $reservation->details,
            //'suites' => $suites_array,
            'segmentation' => $reservation->segmentation,
            'initial' => $initial,
        ];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservation $request, $id)
    {
        // Inicializa variables básicas
        $reservation = Reservation::find($id);

        $dates = $this->getArrayDates(
            $request->fecha_de_entrada,
            $request->fecha_de_salida,
            $request->hora_de_entrada,
            $request->hora_de_salida
        );
        
        // Actualiza la reservación
        $reservation->title    = 'Reservación';
        $reservation->checkin  = $dates['checkin'];
        $reservation->checkout = $dates['checkout'];
        $reservation->start    = $dates['start']->format('Y-m-d H:i:s');
        $reservation->end      = $dates['end']  ->format('Y-m-d H:i:s');
        //$reservation->segmentation = $request->segmentation;
        $reservation->save();

        $reservation->client->update([
            'name'     => $request->nombre,
            'surname'  => $request->apellidos,
            'email'    => $request->email,
            'telefono' => $request->phone,
            'address'  => $request->direccion,
            'state'    => $request->procedencia,
            'country'  => $request->procedencia,
        ]);
        return response()->json(['message' => 'Datos actualizados']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if ($reservation->user->id != auth()->user()->id)
        return response()->json(['message' => 'Usuario no autorizado'], 401);

        $reservation->details()->delete();
        $reservation->segmentation()->delete();
        $reservation->delete();

        return response()->json(['message' => 'Reservación eliminada']);
    }

    /**
     * Devuelve el precio de una reservación
     * 
     * @param \App\Http\Requests\CalculateReservation
     * @return \Illuminate\Http\Response
     */
    public function calculatePrice(CalculateReservation $request)
    {
        $arrTotal = $this->getArrayTotalReservation($request->tipo_pago, $request->tipo);

        return response()->json([
            'message' => $arrTotal['message'],
            'total'   => $arrTotal['value']
        ]);
    }

    /**
     * Crea un cliente en la base de datos con información
     * proveniente de un request
     * 
     */
    private function createClient($request)
    {
        $client = new Client();
        $client->name    = $request->nombre;
        $client->surname = $request->apellidos;
        $client->email   = strtolower($request->email);
        $client->phone   = $request->telefono;
        $client->address = $request->direccion;
        $client->state   = $request->procedencia;
        $client->country = $request->procedencia;
        $client->save();

        return $client;
    }

    /**
     * Registra una tarjeta de crédito en base a un cliente
     */
    private function insertCreditCard($request, $client_id)
    {
        $creditCard = new CreditCard();
        $creditCard->client_id     = $client_id;
        $creditCard->number        = $request->numero_tarjeta;
        $creditCard->expiration    = $request->vencimiento;
        $creditCard->security_code = $request->codigo_seguridad;
        $creditCard->holder        = $request->titular;
        $creditCard->save();

        return $creditCard;
    }

    private function insertReservationDetails($details, $reservation_id)
    {
        foreach ($details as $suite) {
            $detail = new ReservationDetail();
            $detail->reservation_id = $reservation_id;
            $detail->suite_id  = $suite->id;
            $detail->rate_type = $suite->options->tarifa;
            $detail->adults    = $suite->options->adultos;
            $detail->children  = $suite->options->ninios;
            $detail->subtotal  = $suite->subtotal;
            $detail->save();
        }
    }

    private function insertSegmentation($request, $reservation_id)
    {
        $segmentation = new Segmentation();
        $segmentation->reservation_id = $reservation_id;
        $segmentation->name = $request->tipo_de_segmentacion;
        $segmentation->type = $request->tipo;
        $segmentation->channel = $request->canal . $request->canal_grupal;
        $segmentation->save();

        return $segmentation;
    }

    private function getClientsByEmail($email)
    {
        $clients = DB::table('clients')->select('id')
        ->where('email', '=', $email)
        ->get();
        return $clients;
    }

    private function getArrayDates($start_date, $end_date, $start_time, $end_time)
    {
        $arrayDates = [
            'checkin'  => $start_date . ' ' . $start_time,
            'checkout' => $end_date . ' ' . $end_time,
            'start'    => date_create_from_format('d/m/Y h:i A', $start_date . ' ' . $start_time),
            'end'      => date_create_from_format('d/m/Y h:i A', $end_date . ' ' . $end_time),
        ];
        return $arrayDates;
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

    /**
     * Devuelve un array con el total de una reservación
     * dependiendo el método de pago y el canal de segmentación
     * 
     * @var string $payment_method, $sementation_channel
     * @return array
     */
    public function getArrayTotalReservation($payment_method, $sementation_channel)
    {
        // Inicializa variables básicas
        $total          = str_replace(',', '', Cart::initial());
        $total_with_iva = str_replace(',', '', Cart::total());
        $other_taxes    = $total * $this->impuesto_sobre_hospedaje;
        $commissions    = $total * $this->comision_por_otas;
        $msg            = 'No paga impuestos ni comisión';

        // Valida si el tipo de págo es depósito o tarjeta
        if ($this->loadTax($payment_method)) {

            // Total mas impuestos
            $total = $total_with_iva + $other_taxes;
            $msg   = 'Paga IVA 16%, HSH 3.75%';

            if ($this->loadCommission($sementation_channel)) {

                // Total mas impuestos mas comisión
                $total = $total + $commissions;
                $msg  .= ' y 20% comisión por OTAs';
            }
        }
        return [ 'message' => $msg, 'value' => number_format($total, 2) ];
    }
}
