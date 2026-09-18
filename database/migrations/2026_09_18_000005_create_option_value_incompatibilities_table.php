<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Relation symétrique : si A est incompatible avec B,
        // on insère les deux lignes (A,B) et (B,A).
        //
        // Exemple :
        // "verre sur verre" <-> "cartouche position" = à cheval

        Schema::create('option_value_incompatibilities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('option_value_id');

            $table->foreignId('incompatible_with_value_id');

            $table->string('reason')->nullable();
            $table->timestamps();

            // Contraintes avec des noms courts pour respecter
            // la limite de 64 caractères de MySQL.
            $table->foreign('option_value_id', 'ovi_value_fk')
                ->references('id')
                ->on('product_option_values')
                ->cascadeOnDelete();

            $table->foreign('incompatible_with_value_id', 'ovi_incompat_fk')
                ->references('id')
                ->on('product_option_values')
                ->cascadeOnDelete();

            $table->unique(
                ['option_value_id', 'incompatible_with_value_id'],
                'incompat_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('option_value_incompatibilities');
    }
};
