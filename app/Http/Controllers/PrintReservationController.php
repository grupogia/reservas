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
        $start = explode(' ', $reservacion->checkin)[0];
        $end = explode(' ', $reservacion->checkout)[0];

        $nights = $this->getNights($start, $end);

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
        $start_date = date_create_from_format('d/m/Y', $start);
        $end_date   = date_create_from_format('d/m/Y', $end);
        
        $nights = $start_date->diff($end_date)->d;
        return $nights;
    }
}
