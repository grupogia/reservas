<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePaymentReservation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $reservation = $this->route('reservation');
        return $this->user()->id == $reservation->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_pago'        => 'required|string',
            'numero_tarjeta'   => 'required_if:tipo_pago,==,tarjeta|nullable|digits_between:15,16',
            'vencimiento'      => 'required_if:tipo_pago,==,tarjeta|nullable|max:5',
            'codigo_seguridad' => 'required_if:tipo_pago,==,tarjeta|nullable|digits_between:3,4',
            'titular'          => 'required_if:tipo_pago,==,tarjeta|nullable|min:4',
        ];
    }
}
