<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $userTableName = config('laravel-cart.users.table', 'users');
        $userForeignName = config('laravel-cart.users.foreign_id', 'user_id');
        $type = config('laravel-cart.users.foreign_key_type', 'id');
        $table = config('laravel-cart.carts.table', 'carts');

        Schema::create($table, function (Blueprint $table) use ($userTableName, $userForeignName, $type) {
            $table->id();

            if ($type === 'ulid') {
                $table->foreignUlid($userForeignName)
                    ->nullable()
                    ->constrained($userTableName)
                    ->nullOnDelete();
            } elseif ($type === 'uuid') {
                $table->foreignUuid($userForeignName)
                    ->nullable()
                    ->constrained($userTableName)
                    ->nullOnDelete();
            } else {
                $table->foreignId($userForeignName)
                    ->nullable()
                    ->constrained($userTableName)
                    ->nullOnDelete();
            }

            // Colonne pour identifier un panier invité (session id, UUID cookie, etc.)
            $table->string('guest_token')->nullable()->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        $table = config('laravel-cart.carts.table', 'carts');
        Schema::dropIfExists($table);
    }
};