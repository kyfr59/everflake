<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Relation asymétrique : pour sélectionner option_value_id,
        // il faut aussi que required_value_id soit sélectionné.
        // Ex: "position cartouche" = à cheval  requiert  "bordure blanche" = oui
        // Ex: "couleur passe-partout" = * requiert "passe-partout" = oui
        Schema::create('option_value_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_value_id')
                ->constrained('product_option_values')
                ->cascadeOnDelete();
            $table->foreignId('required_value_id')
                ->constrained('product_option_values')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['option_value_id', 'required_value_id'], 'dependency_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('option_value_dependencies');
    }
};
