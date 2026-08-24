<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Binafy\LaravelCart\Models\Cart;

class MergeGuestCartOnLogin
{
    public function handle(Login $event): void
    {
        $token = request()->cookie('guest_cart_token');
        if (! $token) return;

        $guestCart = Cart::query()->where('guest_token', $token)->first();
        if (! $guestCart) return;

        foreach ($guestCart->items as $item) {
            Cart::query()->firstOrCreateWithStoreItems(
                item: $item->itemable,
                quantity: $item->quantity,
                userId: $event->user->id
            );
        }

        $guestCart->delete();
        cookie()->queue(cookie()->forget('guest_cart_token'));
    }
}