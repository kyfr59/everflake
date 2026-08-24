<h1>Produits</h1>

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div>
        {{ session('error') }}
    </div>
@endif

<a href="{{ route('products.create') }}">
    Nouveau produit
</a>

<hr>

@forelse($products as $product)

    <article>
        <h2>
            <a href="{{ route('products.show', $product) }}">
                {{ $product->name }}
            </a>
        </h2>

        <p>
            {{ $product->description }}
        </p>

        <p>
            {{ number_format($product->price / 100, 2, ',', ' ') }} €
        </p>

        <p>
            Stock : {{ $product->stock }}
        </p>

        <a href="{{ route('products.edit', $product) }}">
            Modifier
        </a>

        <form
            method="POST"
            action="{{ route('cart.add', $product) }}"
        >
            @csrf

            <button type="submit">
                Ajouter au panier
            </button>
        </form>

        <form
            method="POST"
            action="{{ route('products.destroy', $product) }}"
        >
            @csrf
            @method('DELETE')

            <button type="submit">
                Supprimer
            </button>
        </form>
    </article>

    <hr>

@empty

    <p>Aucun produit.</p>

@endforelse

{{ $products->links() }}

<a href="{{ route('cart.index') }}">
    Voir le panier
</a>