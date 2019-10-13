<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationDetail extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $is_user = $this->route('detail')->reservation->user->id === $this->user()->id;
        return $this->user()->can('edit.reservation') && $is_user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'habitacion' => 'required|numeric|min:0|exists:suites,id',
            'tarifa'     => 'required|string|exists:rates,type',
            'adultos'    => 'required|numeric|min:1',
            'ninios'     => 'required|numeric|min:0',
            //'precio' => 'required|numeric',
        ];
    }
}
