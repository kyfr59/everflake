<?php

namespace App\Services;

use Binafy\LaravelCart\Models\Cart;

class CartResolver
{
    public function resolve(): ?Cart
    {
        if (auth()->check()) {
            return Cart::query()->where('user_id', auth()->id())->first();
        }

        $token = request()->cookie('guest_cart_token');

        if (! $token) {
            return null;
        }

        return Cart::query()->where('guest_token', $token)->first();
    }
}