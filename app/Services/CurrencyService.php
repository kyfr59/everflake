<?php

namespace App\Services;

use App\Models\Currency;
use Number;

class CurrencyService
{
    /**
     * Attention : le taux de changer doit être changé tous les jours
     * via l'appel à une API et stocké en base pour la journée
     */
    public function convert(int $amountInCents, string $toCurrency): int
    {
        $currency = Currency::where('code', $toCurrency)->first();

        if (!$currency) {
            // fallback sur la devise par défaut plutôt que de crasher
            $currency = Currency::where('is_default', true)->firstOrFail();
        }

        return (int) round($amountInCents * $currency->exchange_rate);
    }

    public function format(int $amountInCents, string $currencyCode): string
    {
        $amount = $amountInCents / 100;

        $formatted = $amount == floor($amount)
            ? number_format($amount, 0, '.', "'")
            : number_format($amount, 2, '.', "'");

        return match ($currencyCode) {
            'CHF' => $amount == floor($amount)
                ? 'CHF ' . $formatted . '.-'
                : 'CHF ' . $formatted,

            'EUR' => $formatted . ' €',

            default => $formatted . ' ' . $currencyCode,
        };
    }

}