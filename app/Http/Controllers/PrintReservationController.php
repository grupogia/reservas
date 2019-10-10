<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;

class PrintReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Reservation $reservacion, Html2Pdf $html2Pdf)
    {
        $nights = $this->getNights($reservacion->start, $reservacion->end);

        $page = view('pdf.reservacion', compact('reservacion', 'nights'));

        $html2Pdf->writeHTML($page);

        return $html2Pdf->output('reservacion'. $reservacion->folio .'_'. date('d-m-Y') .'.pdf');
    }

    /**
     * Obtiene el número de noches dependiendo de un rango de fechas.
     * 
     * @param $start
     * @param $end
     */
    public function getNights($start, $end)
    {
        $start_date = date_create_from_format('Y-m-d H:i:s', $start);
        $end_date   = date_create_from_format('Y-m-d H:i:s', $end);
        
        $nights = $start_date->diff($end_date)->d;
        return $nights;
    }
}
