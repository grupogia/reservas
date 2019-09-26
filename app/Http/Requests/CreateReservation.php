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
            'nombre'      => 'required|string',
            'apellidos'   => 'required|string',
            'email'       => 'required|email',
            'telefono'    => 'required|digits:10',
            'direccion'   => 'required|string|min:4',
            'procedencia' => 'required|min:4',

            /* 
             * Datos de la reserva
             */
            'fecha_de_entrada' => 'required',
            'fecha_de_salida'  => 'required',
            'hora_de_entrada'  => 'required',
            'hora_de_salida'   => 'required',

            /*
             * Datos del pago
             */
            'tipo_pago' => 'required',

            // Tarjeta
            'numero_tarjeta'   => 'required_if:tipo_pago,==,tarjeta|nullable|digits_between:15,16',
            'vencimiento'      => 'required_if:tipo_pago,==,tarjeta|nullable|max:5',
            'codigo_seguridad' => 'required_if:tipo_pago,==,tarjeta|nullable|digits:3',
            'titular'          => 'required_if:tipo_pago,==,tarjeta|nullable|min:4',

            // Efectivo o depósito
            'monto' => 'required_if:tipo_pago,==,efectivo|required_if:tipo_pago,==,deposito|nullable|numeric',

            /*
             * Datos de segmentación
             */
            'tipo_de_segmentacion' => 'required',
            'canal_grupal' => 'required_if:tipo_de_segmentacion,==,grupal',
            'tipo'     => 'required_if:tipo_de_segmentacion,==,individual',
            'canal'    => 'required_with:tipo',
            'notas'    => 'nullable|string|max:100',
        ];
    }

    /**
     * Valida que el carrito de compras no esté vacio
     */
    public function withValidator($validator)
    {        
        $validator->after(function ($validator) {
            if (Cart::initial() <= 0) {
                $validator->errors()->add('field', '<strong>Debe reservar al menos una habitación.</strong>');
            }
        });
    }
}
