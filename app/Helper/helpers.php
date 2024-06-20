<?php

//This file is for the function that will use on the controller or others, just the function.
//Make sure to configure on the .env file called autoload so that this function can be called and reuse anywhere.

/** get total cart amount */

function getCartTotal(){
    $total = 0;
    foreach(\Cart::content() as $product){
        $total += $product->price * $product->qty;
    }
    return $total;
}