<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['code', 'symbol', 'exchange_rate', 'is_default'];

    public static function default(): self
    {
        return static::where('is_default', true)->firstOrFail();
    }
}