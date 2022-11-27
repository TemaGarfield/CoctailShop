<?php

namespace App\controller;

use App\model\Cart;

class CartController
{
    private Cart $cart;

    public function __construct(Cart $cart) {
        $this->cart = $cart;
    }

    public function addToCart(): void {
        if ($_POST['size_id'] != '--' && isset($_POST['size_id'], $_POST['cocktail_id'], $_POST['count'])) {
            if ((int) $_POST['count'] != 0){
                $this->cart->addToCart($_POST);
            } else {
                echo 'ne success';
            }
        } else {
            echo 'ne success';
        }
    }
}