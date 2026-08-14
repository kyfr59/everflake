<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

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
});
