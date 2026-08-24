<h1>Nouveau produit</h1>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <div>
        <label>Nom</label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >
    </div>

    <div>
        <label>Description</label>

        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label>Prix en centimes</label>

        <input
            type="number"
            name="price"
            value="{{ old('price', 0) }}"
            min="0"
            required
        >
    </div>

    <div>
        <label>Stock</label>

        <input
            type="number"
            name="stock"
            value="{{ old('stock', 0) }}"
            min="0"
            required
        >
    </div>

    <div>
        <label>
            <input
                type="checkbox"
                name="active"
                value="1"
                checked
            >

            Actif
        </label>
    </div>

    <button type="submit">
        Créer
    </button>
</form>

<a href="{{ route('products.index') }}">
    Retour
</a>