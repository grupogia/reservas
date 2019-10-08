<?php

namespace App\Http\Requests;

use App\Suite;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;

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
            'habitacion' => 'required|numeric|min:1',
            'tarifa'     => 'required|string',
            'adultos'    => 'required|numeric|min:1|max:10',
            'ninios'     => 'required|numeric|max:10',
        ];
    }

    public function withValidator($validator)
    {
        $id     = $this->route('product');
        $tarifa = strtolower($this->input('tarifa'));

        $is_product = Cart::content()
        ->where('id', '=', $id)->count();

        $rates = Suite::find($id)->rates()
        ->where('type', '=', $tarifa)->count();

        $validator->after(function ($validator) use ($is_product, $rates) {
            if ($is_product > 0)
            $validator->errors()->add('cart', 'Habitación ya asignada');

            if ($rates <= 0)
            $validator->errors()->add('rate', 'No se encontró una tarifa para esta habitación');
        });
    }
}
