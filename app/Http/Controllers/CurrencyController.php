<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\CartResolver;
use Illuminate\Http\RedirectResponse;

class CurrencyController extends Controller
{
    public function __construct(private CartResolver $cartResolver)
    {
    }

    public function switch(string $code): RedirectResponse
    {
        $currency = Currency::where('code', strtoupper($code))->first();

        if (! $currency) {
            return redirect()->back(fallback: route('home'))
                ->with('error', 'Devise non supportée.');
        }

        session(['currency' => $currency->code]);

        $cart = $this->cartResolver->resolve();

        if ($cart) {
            $cart->items()->update([
                'currency'      => $currency->code,
                'exchange_rate' => $currency->exchange_rate,
            ]);
        }

        return redirect()->back(fallback: route('home'));
    }
}