<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    //

    public function cartContent(){
        return $cart=\Cart::getSubTotal();
        return    $cart = array([
            'items' => \Cart::getContent()->toArray(),
            'cartCount' => \Cart::getTotalQuantity(),
            'cartSubTotal' => \Cart::getSubTotal(),
            'cartTotal' => \Cart::getTotal(),
        ]);
    }
}
