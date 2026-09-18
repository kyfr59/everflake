<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CurrencyController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Page d'accueil
Route::get('/', function (Request $request) {
    $locale = $request->getPreferredLanguage(['fr', 'en', 'de']);
    return redirect("/{$locale}");
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::resource('collection', ProductController::class)
        ->only(['index', 'show'])
        ->parameters(['collection' => 'product'])
        ->names([
            'index' => 'products.index',
            'show'  => 'products.show',
        ]);

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/{item}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{item}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::delete('/cart', [CartController::class, 'clear'])
        ->name('cart.clear');

    Route::post('/products/{product}/price', [ProductController::class, 'computePrice'])
    ->name('products.price');

    Route::get('/currency/switch/{code}', [CurrencyController::class, 'switch'])
    ->name('currency.switch');

    Route::get('/dashboard', function () {
        return view('home');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    require __DIR__.'/auth.php';
});

/*
GET     /products
GET     /products/create
POST    /products
GET     /products/{product}
GET     /products/{product}/edit
PUT     /products/{product}
DELETE  /products/{product}

GET     /cart
POST    /cart/{product}
PATCH   /cart/{item}
DELETE  /cart/{item}
DELETE  /cart
*/