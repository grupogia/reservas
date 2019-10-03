<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSuiteToCart;
use App\Suite;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Devuelve los datos del carrito
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCart = [
            'content' => Cart::content(),
            'initial' => Cart::initial(),
            'total'   => Cart::total(),
        ];

        return response()->json($dataCart);
    }

    /**
     * Agrega una habitación al carrito
     * 
     * @param \App\Http\Requests\AddSuiteToCart
     * @return \Illuminate\Http\Response
     */
    public function add(AddSuiteToCart $request, $product) {
        $suite = Suite::find($product);
        $data  = $request->validated();

        // Tarifa
        $rate          = $suite->rates->where('type', '=', $data['tarifa'])->first();
        $adultos       = $data['adultos'];
        $extra_persons = $this->getPricePerPerson($adultos);

        $price = floatval($rate->price) + $extra_persons;

        $options = [
            'tarifa'   => $rate->type,
            'bed_type' => $suite->bed_type,
            'adultos'  => $adultos,
            'ninios'   => $data['ninios'],
        ];

        Cart::add($suite->id, $suite->number . ' ' . $suite->title, 1, $price, 0, $options);
        return response()->json([ 'message' => 'Habitación asignada', 'price' => number_format($price, 2) ]);
    }

    /**
     * Elimina una habitación cargada en el carrito
     * 
     * @param $product
     */
    public function remove($product) {
        return response($product);
    }

    /**
     * Vacia el carrito
     * 
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        Cart::destroy();
        return response()->json(['success' => 'Carrito vacio']);
    }

    public function getPricePerPerson($persons)
    {
        $price_per_person = 0;

        if ($persons > 2) {
            $price_per_person = 700 * ($persons - 2);
        }

        return $price_per_person;
    }
}
