<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\CalculateReservation;
use App\Reservation;
use App\ReservationDetail;
use App\Http\Requests\CreateReservation;
use App\Http\Requests\UpdateReservation;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class ReservationController extends Controller
{
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
        ];

        if (!empty($_GET['start']) && !empty($_GET['end'])) {
            $reservations = DB::table($table)
            ->select($columns)
            ->join('clients', 'reservations.client_id', '=', 'clients.id')
            ->join('reservation_details', 'reservations.id', '=', 'reservation_details.reservation_id')
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReservation $request)
    {
        // Inicializa variables básicas
        $dates = $this->getArrayDates(
            $request->fecha_de_entrada,
            $request->fecha_de_salida,
            $request->hora_de_entrada,
            $request->hora_de_salida
        );
        $total = Cart::initial();

        // Valida si el tipo de págo es depósito o tarjeta
        if ($this->loadTax($request->tipo_pago)) {
            $total = Cart::total();

            if ($this->loadCommission($request->tipo)) {
                $total = str_replace(',', '', $total) * 1.2;
                die ('paga impuestos y comisión ' . $total);
            }
            die('paga impuestos ' . $total);
        }

        // Valida si ya existe el cliente
        $is_client = $this->getClientsByEmail($request->email);

        // Obtiene o crea el cliente en la DB
        if (count($is_client)) {
            $client = Client::find($is_client[0]->id);

        } else {
            $client = $this->createClient($request);
        }

        // Crea la reservación
        $reservation = new Reservation();
        $reservation->user_id   = auth()->user()->id;
        $reservation->client_id = $client->id;
        $reservation->title    = 'Reservación';
        $reservation->folio    = 2;
        $reservation->checkin  = $dates['checkin'];
        $reservation->checkout = $dates['checkout'];
        $reservation->start    = $dates['start']->format('Y-m-d H:i:s');
        $reservation->end      = $dates['end']  ->format('Y-m-d H:i:s');
        $reservation->segmentation = $request->canal . $request->canal_grupal;
        $reservation->payment_method = $request->tipo_pago;
        $reservation->total = $total;
        
        $reservation->save();

        // Inserta las habitaciones cargadas del carrito a la DB
        $this->insertReservationDetails(Cart::content(), $reservation->id);

        // Vacía el carrito
        Cart::destroy();
        return response()->json(['success' => 'Reservación correcta']);
    }

    /**
     * Display the specified resource.
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
        return response(['data' => $request], 422);

        // Validar cliente
        $is_client = $this->getClientsByEmail($request->email);

        // Busca o crea el cliente en la DB
        if (count($is_client)) {
            $client = Client::find($is_client[0]->id);

        } else {
            $client = $this->createClient($request);
        }
        
        // Actualiza la reservación
        $reservation->user_id   = auth()->user()->id;
        $reservation->client_id = $client->id;
        $reservation->title     = 'Reservación';
        $reservation->folio     = 2;
        $reservation->checkin   = $dates['checkin'];
        $reservation->checkout  = $dates['checkout'];
        $reservation->start     = $dates['start']->format('Y-m-d H:i:s');
        $reservation->end       = $dates['end']  ->format('Y-m-d H:i:s');
        $reservation->payment_method = $request  ->tipo_pago;
        //$reservation->segmentation = $request->segmentation;
        
        $reservation->save();

        $collected = [
            'reservation' => $reservation,
            'details' => $reservation->details,
        ];
        
        return response()->json($collected);
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
        $reservation->details()->delete();
        $reservation->delete();

        return response()->json(['message' => 'Reservación eliminada']);
    }

    /**
     * Calcula el precio de la reservación
     */
    public function calculatePrice(CalculateReservation $request)
    {
        // Inicializa variables básicas
        $total = Cart::initial();
        $msg = 'No paga impuestos ni comisión';

        // Valida si el tipo de págo es depósito o tarjeta
        if ($this->loadTax($request->tipo_pago)) {
            $total = Cart::total();

            if ($this->loadCommission($request->tipo)) {
                $total = number_format(str_replace(',', '', $total) * 1.2);
                $msg = 'Paga 16% de impuestos y  20% de comisión por OTAs';

                return response()->json(['message' => $msg, 'total' => $total]);
            }
            $msg = 'Paga 16% de impuestos';
        }
        return response()->json(['message' => $msg, 'total' => $total]);
    }

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

    private function insertReservationDetails($details, $reservation_id)
    {
        foreach ($details as $suite) {
            $detail = new ReservationDetail();
            $detail->reservation_id = $reservation_id;
            $detail->suite_id = $suite->id;
            $detail->rate_type = $suite->options->tarifa;
            $detail->adults   = $suite->options->adultos;
            $detail->children = $suite->options->ninios;
            $detail->subtotal = $suite->subtotal;

            $detail->save();
        }
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

    private function loadTax($payment_method)
    {
        if ($payment_method == 'deposito' || $payment_method == 'tarjeta')
        return true;
        else return false;
    }

    private function loadCommission($channel)
    {
        if ($channel == 'otas')
        return true;
        else return false;
    }
}
