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
        $page = view('pdf.reservacion', compact('reservacion'));

        $html2Pdf->writeHTML($page);

        return $html2Pdf->output('reservacion'. $reservacion->folio .'_'. date('d-m-Y') .'.pdf');
    }
}
