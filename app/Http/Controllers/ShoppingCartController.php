<?php

namespace App\Http\Controllers;

use App\Suite;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $dataCart = [
            'content' => Cart::content(),
            'total' => Cart::total(),
        ];

        return $dataCart;
    }

    public function add(Request $request, $product) {
        $request->validate([
            'habitacion' => 'required',
            'tarifa' => 'required'
        ]);

        $suite = Suite::find($product);

        // Cart::add($suite->id, $suite->id. ' ' .$suite->title, 1, $price);
        return response($request->tarifa);
    }

    public function remove($product) {
        return response($product);
    }
}
