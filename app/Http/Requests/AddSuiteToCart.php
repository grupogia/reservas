<?php

namespace App\Http\Requests;

use App\Reservation;
use App\Suite;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class AddSuiteToCart extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create.reservation');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'habitacion'       => 'required|numeric|min:1',
            'tarifa'           => 'required|string',
            'adultos'          => 'required|numeric|min:1|max:10',
            'ninios'           => 'required|numeric|max:10',
            'fecha_de_entrada' => 'required|date_format:d/m/Y',
            'fecha_de_salida'  => 'required|date_format:d/m/Y|after:fecha_de_entrada',
        ];
    }

    /**
     * Segunda validación
     * 
     */
    public function withValidator($validator)
    {
        $id     = $this->route('product');
        $tarifa = strtolower($this->input('tarifa'));

        $is_product = Cart::content()
        ->where('id', '=', $id)->count();

        $rates = Suite::find($id)->rates()
        ->where('type', '=', $tarifa)->count();

        $validator->after(function ($validator) use ($is_product, $rates, $id) {
            if ($is_product > 0)
            $validator->errors()->add('cart', 'Habitación ya asignada');

            if ($rates <= 0)
            $validator->errors()->add('rate', 'No se encontró una tarifa para esta habitación');

            $from_format = 'd/m/Y';
            $date_start  = date_create_from_format($from_format, $this->input('fecha_de_entrada'));
            $date_end    = date_create_from_format($from_format, $this->input('fecha_de_salida'));

            $reservations = $this->getReservationsFromDates($date_start, $date_end);
            $this->validateArrayReservations($validator, $reservations, $id);
        });
    }

    public function getReservationsFromDates($date_start, $date_end, $to_format = 'Y-m-d H:i:s')
    {
        $reservations = DB::table('reservations')->select()
        ->whereBetween('start', [ $date_start->format($to_format), $date_end->format($to_format) ])
        ->orWhereBetween('end', [ $date_start->format($to_format), $date_end->format($to_format) ])
        ->orWhereDate('start', '<', $date_start->format($to_format))
        ->orWhereDate('end', '>', $date_start->format($to_format))
        ->orWhereDate('start', '<', $date_end->format($to_format))
        ->orWhereDate('end', '>', $date_end->format($to_format))
        ->get();

        return $reservations;
    }

    public function validateArrayReservations($validator, $reservations, $product_id)
    {
        foreach ($reservations as $reserv) {
            $res = [];
            $reservation = Reservation::find($reserv->id);
    
            foreach ($reservation->details as $detail) {
                $suite_id = $detail->suite->id;
                $res[] = $suite_id;
    
                if ($suite_id == $product_id)
                $validator->errors()->add('disp', '<br>La habitación ya está ocupada en la fecha solicitada.');
            }
        }
    }
}
