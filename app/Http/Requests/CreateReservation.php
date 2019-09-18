<?php

namespace App\Http\Requests;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;

class CreateReservation extends FormRequest
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
            /*
             * Datos del cliente
             */
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string|size:10',
            'direccion' => 'required|string|min:4',
            'procedencia' => 'required|min:4',

            /* 
             * Datos de la reserva
             */
            'fecha_de_entrada' => 'required',
            'fecha_de_salida' => 'required',
            'hora_de_entrada' => 'required',
            'hora_de_salida' => 'required',

            /*
             * Datos del pago
             */
            'tipo_pago' => 'required',

            // Tarjeta
            'numero_tarjeta' => 'required_if:tipo_pago,==,tarjeta|nullable|numeric',
            'vencimiento' => 'required_if:tipo_pago,==,tarjeta',
            'codigo_seguridad' => 'required_if:tipo_pago,==,tarjeta|nullable|min:3|max:3',
            'titular' => 'required_if:tipo_pago,==,tarjeta',

            // Efectivo o depósito
            'monto' => 'required_if:tipo_pago,==,efectivo|required_if:tipo_pago,==,deposito|nullable|numeric',

            /*
             * Datos de segmentación
             */
            'tipo_de_reserva' => 'required',
            'directas' => 'required_if:tipo_de_reserva,==,individual',
            'sociales' => 'required_if:tipo_de_reserva,==,grupal',
            'notas' => 'nullable|string|max:100',
        ];
    }

    /**
     * Valida que el carrito de compras no esté vacio
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (Cart::initial() == 0) {
                $validator->errors()->add('field', 'Debe asignar almenos una habitación.');
            }
        });
    }
}
