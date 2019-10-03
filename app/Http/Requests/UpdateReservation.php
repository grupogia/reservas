<?php

namespace App\Http\Requests;

use App\Reservation;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $reservation = Reservation::find($this->route('reservacione'));
        return $this->user()->id == $reservation->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /*
             * Datos del cliente
             */
            'nombre'      => 'required|string|min:4',
            'apellidos'   => 'required|string|min:4',
            'email'       => 'required|email',
            'telefono'    => 'required|string|size:10',
            'direccion'   => 'required|string|min:4',
            'procedencia' => 'required|min:4',

            /* 
             * Datos de la reserva
             */
            'fecha_de_entrada' => 'required|date_format:d/m/Y',
            'fecha_de_salida'  => 'required|date_format:d/m/Y',
            'hora_de_entrada'  => 'required|date_format:h:i A',
            'hora_de_salida'   => 'required|date_format:h:i A',

            /*
             * Datos del pago
             */
            'tipo_pago' => 'required|min:3',

            // Tarjeta
            /*
            'numero_tarjeta' => 'required_if:tipo_pago,==,tarjeta|nullable|numeric',
            'vencimiento' => 'required_if:tipo_pago,==,tarjeta',
            'codigo_seguridad' => 'required_if:tipo_pago,==,tarjeta|nullable|min:3|max:3',
            'titular' => 'required_if:tipo_pago,==,tarjeta',*/

            // Efectivo o depósito
            /*
            'monto' => 'required_if:tipo_pago,==,efectivo|required_if:tipo_pago,==,deposito|nullable|numeric',
            */

            /*
             * Datos de segmentación
             */
            'tipo_de_reserva' => 'nullable',
            /*
            'directas' => 'required_if:tipo_de_reserva,==,individual',
            'sociales' => 'required_if:tipo_de_reserva,==,grupal',
            'canal' => 'required',*/
            'notas' => 'nullable|string|max:100',
        ];
    }
}
