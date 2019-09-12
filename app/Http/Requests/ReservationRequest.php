<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Datos del cliente
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'procedencia' => 'required',

            // Datos de la reserva
            'fecha_de_entrada' => 'required',
            'fecha_de_salida' => 'required',
            'hora_de_entrada' => 'required',
            'hora_de_salida' => 'required',
            'adultos' => 'required',
            'ninos' => 'required',

            // Datos del pago
            'tipo_pago' => 'required',
            'n_tarjeta' => 'required',
            'vencimiento' => 'required',
            'codigo_seguridad' => 'required',
            'titular' => 'required',

            // Datos de segmentación
            'tipo_de_reserva' => 'nullable',
            'notas' => 'nullable',
        ];
    }
}
