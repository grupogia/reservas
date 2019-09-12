<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ReservationRequest;
use App\Reservation;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = DB::table('reservations')
        ->join('clients', 'reservations.client_id', '=', 'clients.id')
        ->get();

        return response()->json($reservations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        // Validar cliente
        $is_client = DB::table('clients')
        ->select()
        ->where('email', '=', $request->email)->get();

        if (count($is_client)) {
            $client = Client::find($is_client[0]->id);

        } else {
            $client = new Client();
            $client->name = $request->nombre;
            $client->surname = $request->apellidos;
            $client->email = $request->email;
            $client->phone = $request->telefono;
            $client->address = $request->direccion;
            $client->state = $request->procedencia;
            $client->country = $request->procedencia;
    
            $client->save();
        }

        foreach (Cart::content() as $suite) {
            $start = new \DateTime($request->fecha_de_entrada . ' ' . $request->hora_de_entrada);
            $end = new \DateTime($request->fecha_de_salida. ' ' . $request->hora_de_salida);

            $reservation = new Reservation();
            $reservation->user_id = auth()->user()->id;
            $reservation->client_id = $client->id;
            $reservation->resourceId = $suite->id;

            $reservation->title = 'Reserva de Habitación';
            $reservation->folio = 2;
            $reservation->checkin = $request->fecha_de_entrada . ' ' . $request->hora_de_entrada;
            $reservation->checkout = $request->fecha_de_salida . ' ' . $request->hora_de_salida;
            $reservation->payment_method = $request->tipo_pago;
            $reservation->start = $start->format('Y-d-m H:i:s');
            $reservation->end = $end->format('Y-d-m H:i:s');
            
            $reservation->save();
        }

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        return $request;
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
}
