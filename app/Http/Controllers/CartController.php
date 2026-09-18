<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Binafy\LaravelCart\Models\Cart;
use App\Services\CartResolver;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private CartResolver $cartResolver)
    {
    }

    /**
     * Récupère le panier courant : utilisateur connecté OU invité (via cookie).
     * Ne crée PAS de panier si aucun n'existe (utilisé pour l'affichage).
     */
    private function resolveCart(): ?Cart
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

    /**
     * Récupère OU crée le panier courant, en posant le cookie si besoin (invité).
     * Retourne le panier + un cookie éventuel à attacher à la réponse.
     */
    private function resolveOrCreateCart(): array
    {
        if (auth()->check()) {
            $cart = Cart::query()->firstOrCreate(['user_id' => auth()->id()]);
            return [$cart, null];
        }

        $token = request()->cookie('guest_cart_token');
        $newCookie = null;

        if (! $token) {
            $token = Str::uuid()->toString();
            $newCookie = cookie('guest_cart_token', $token, 60 * 24 * 30); // 30 jours
        }

        $cart = Cart::query()->firstOrCreate(['guest_token' => $token]);

        return [$cart, $newCookie];
    }

    public function index(): View
    {
        $cart = $this->cartResolver->resolve();
        $items = $cart ? $cart->items()->get() : collect();

        return view('cart.index', compact('cart', 'items'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        if (!$product->active) {
            return back()->with('error', 'Produit indisponible.');
        }

        // @TODO : ) gérer en fonction de la dispo du cadre
        /*
        if ($product->stock < 1) {
            return back()->with('error', 'Produit en rupture de stock.');
        }
            */

        [$cart, $newCookie] = $this->resolveOrCreateCart();

        // @TODO : A ajuster
        $validated = $request->validate([
            'size'     => 'required|string',
            'color'    => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $unitPrice = $product->getPriceWithOptions([
            'size'  => $validated['size'],
            'color' => $validated['color'],
        ]);

        $displayCurrency = session('currency', 'CHF');
        $exchangeRate = \App\Models\Currency::where('code', $displayCurrency)->value('exchange_rate') ?? 1;


        $cart->storeItem([
            'itemable'      => $product,
            'quantity'      => $validated['quantity'],
            'currency'      => $displayCurrency,
            'exchange_rate' => $exchangeRate,   // ✅ corrigé (plus de "_snapshot")
            'options'       => json_encode([
                'size'       => $validated['size'],
                'color'      => $validated['color'],
                'unit_price' => $unitPrice,
            ]),
        ]);

        $response = back()->with('success', 'Produit ajouté au panier.');

        if ($newCookie) {
            $response->withCookie($newCookie);
        }

        return $response;
    }

    public function update($item): RedirectResponse
    {
        // À adapter selon l'API exacte de la version installée
        return back();
    }

    public function remove($item): RedirectResponse
    {
        $cart = $this->cartResolver->resolve();
        abort_if(! $cart, 404);

        $cartItem = $cart->items()->whereKey($item)->firstOrFail();
        $cartItem->delete();

        return back()->with('success', 'Produit supprimé du panier.');
    }

    public function clear(): RedirectResponse
    {
        $cart = $this->cartResolver->resolve();

        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Panier vidé.');
    }
}