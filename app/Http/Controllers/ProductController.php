<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['active'] = $request->boolean('active');

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit créé.');
    }

    public function show(Product $product): View
    {
        $options = $product->options()->get();

        return view('products.show', compact('product', 'options'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['active'] = $request->boolean('active');

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit modifié.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé.');
    }

    /**
     * Calcule le prix en fonction des options choisies (appelé via AJAX).
     */
public function computePrice(Request $request, Product $product)
{
    $validated = $request->validate([
        'option_id' => ['nullable', 'integer', 'exists:product_options,id'],
        'quantity' => ['nullable', 'integer', 'min:1'],
    ]);

    $quantity = $validated['quantity'] ?? 1;

    $price = $product->price;

    if (!empty($validated['option_id'])) {
        $option = $product->options()
            ->where('id', $validated['option_id'])
            ->first();

        if ($option) {
            $price += $option->price_modifier;
        }
    }

    return response()->json([
        'total_price' => $price * $quantity,
    ]);
}

    /**
     * Ajoute le produit configuré au panier.
     */
    public function addToCart(Request $request, Product $product)
    {
        $validated = $request->validate([
            'size'     => 'required|string',
            'color'    => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $unitPrice = $product->getPriceWithOptions([
            'size'  => $validated['size'],
            'color' => $validated['color'],
        ]);

        $cart = Cart::query()->firstOrCreate(['user_id' => auth()->id()]);

        $cart->storeItem([
            'itemable' => $product,
            'quantity' => $validated['quantity'],
            'options'  => json_encode([
                'size'       => $validated['size'],
                'color'      => $validated['color'],
                'unit_price' => $unitPrice, // prix figé au moment de l'ajout
            ]),
        ]);

        return response()->json(['message' => 'Ajouté au panier']);
    }

}