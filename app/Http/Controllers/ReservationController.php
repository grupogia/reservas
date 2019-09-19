<?php

namespace App\Http\Controllers;

use App\Client;
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
        $start    = date_create_from_format('d/m/Y h:i A', $request->fecha_de_entrada . ' ' . $request->hora_de_entrada);
        $end      = date_create_from_format('d/m/Y h:i A', $request->fecha_de_salida . ' ' . $request->hora_de_salida);
        $checkin  = $request->fecha_de_entrada . ' ' . $request->hora_de_entrada;
        $checkout = $request->fecha_de_salida . ' ' . $request->hora_de_salida;

        // Validar cliente
        $is_client = DB::table('clients')->select('email')
        ->where('email', '=', $request->email)
        ->get();

        // Busca o crea el cliente en la DB
        if (count($is_client)) {
            $client = Client::find($is_client[0]->id);

        } else {
            $client = $this->createClient($request);
        }

        // Crea la reservación
        $reservation = new Reservation();
        $reservation->user_id   = auth()->user()->id;
        $reservation->client_id = $client->id;

        $reservation->title    = 'Reserva de Habitación';
        $reservation->folio    = 2;
        $reservation->checkin  = $checkin;
        $reservation->checkout = $checkout;
        $reservation->payment_method = $request->tipo_pago;
        $reservation->start    = $start->format('Y-m-d H:i:s');
        $reservation->end      = $end->format('Y-m-d H:i:s');
        
        $reservation->save();

        // Inserta las habitaciones cargadas en el carrito
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
        //
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
        $start       = date_create_from_format('d/m/Y h:i A', $request->fecha_de_entrada . ' ' . $request->hora_de_entrada);
        $end         = date_create_from_format('d/m/Y h:i A', $request->fecha_de_salida . ' ' . $request->hora_de_salida);
        $checkin     = $request->fecha_de_entrada . ' ' . $request->hora_de_entrada;
        $checkout    = $request->fecha_de_salida . ' ' . $request->hora_de_salida;

        // Validar cliente
        $is_client = DB::table('clients')->select('email')
        ->where('email', '=', $request->email)
        ->get();

        // Busca o crea el cliente en la DB
        if (count($is_client)) {
            $client = Client::find($is_client[0]->id);

        } else {
            $client = $this->createClient($request);
        }
        
        // Actualiza la reservación
        $reservation->user_id   = auth()->user()->id;
        $reservation->client_id = $client->id;
        $reservation->title     = 'Reserva de Habitación';
        $reservation->folio     = 2;
        $reservation->checkin   = $checkin;
        $reservation->checkout  = $checkout;
        $reservation->payment_method = $request->tipo_pago;
        $reservation->start     = $start->format('Y-m-d H:i:s');
        $reservation->end       = $end->format('Y-m-d H:i:s');
        
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
        //
    }

    private function createClient($request)
    {
        $client = new Client();
        $client->name    = $request->nombre;
        $client->surname = $request->apellidos;
        $client->email   = $request->email;
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
            $detail->adults   = $suite->options->adultos;
            $detail->children = $suite->options->ninios;
            $detail->subtotal = $suite->subtotal;

            $detail->save();
        }
    }
}
