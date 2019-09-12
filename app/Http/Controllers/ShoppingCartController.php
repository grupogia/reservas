<?php

namespace App\Http\Controllers;

use App\Suite;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Devuelve los datos del carrito
     */
    public function index()
    {
        $dataCart = [
            'content' => Cart::content(),
            'initial' => Cart::initial(),
            'total' => Cart::total(),
        ];

        return response()->json($dataCart);
    }

    /**
     * Agrega una habitación al carrito
     */
    public function add(Request $request, $product) {
        $request->validate([
            'habitacion' => 'required',
            'tarifa' => 'required'
        ]);

        $suite = Suite::find($product);

        foreach ($suite->rates as $rate) {
            
            if ($rate->type == strtolower($request->tarifa)) {
                $price = floatval($rate->price);

                Cart::add($suite->id, $suite->id. ' ' .$suite->title, 1, $price, 0, ['tarifa' => $rate->type, 'bed_type' => $suite->bed_type]);
                return response()->json(['price' => number_format($price, 2)]);
            }
        }
    }

    /**
     * Elimina una habitación cargada en el carrito
     */
    public function remove($product) {
        return response($product);
    }

    /**
     * Vacia el carrito
     */
    public function trash()
    {
        Cart::destroy();
        return response()->json(['success' => 'Carrito vacio']);
    }
}
