<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Permet de définir, pour un produit donné (une photo par ex.),
        // quels groupes d'options s'appliquent, s'ils sont obligatoires,
        // et dans quel ordre les afficher.
        Schema::create('product_option_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_option_group_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_required')->default(false);
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'product_option_group_id'], 'product_group_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_option_group');
    }
};
