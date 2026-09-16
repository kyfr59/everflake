<?php

namespace App\Providers;

use App\Services\CartResolver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('partials.nav', function ($view) {
            $cart = app(CartResolver::class)->resolve();
            $cartCount = $cart ? $cart->items->sum('quantity') : 0;

            $view->with('cartCount', $cartCount);
        });
    }
}