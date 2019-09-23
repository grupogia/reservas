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
            'tarifa' => 'required',
            'adultos' => 'required|numeric',
            'ninios' => 'required|numeric',
        ]);

        $suite = Suite::find($product);

        foreach ($suite->rates as $rate) {
            
            if ($rate->type == strtolower($request->tarifa)) {
                $price = floatval($rate->price);

                Cart::add($suite->id, $suite->number. ' ' .$suite->title, 1, $price, 0, ['tarifa' => $rate->type, 'bed_type' => $suite->bed_type, 'adultos' => $request->adultos, 'ninios' => $request->ninios]);
                return response()->json(['message' => 'Habitación asignada', 'price' => number_format($price, 2)]);
            }
        }
        return response()->json([
            'errors' => [
                0 => 'No se encontró una tarifa para esta habitación'
            ]
        ], 422);
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
