<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('veille_innovations', function (Blueprint $table) {
            $table->id();
            $table->string('categorie'); // fintech, monetaire, numerique, verte, ia, crypto
            $table->string('titre');
            $table->text('resume');
            $table->string('impact'); // Élevé, Moyen, Faible
            $table->string('source');
            $table->string('region');
            $table->string('date_publication');
            $table->text('pertinence_afrique')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veille_innovations');
    }
};
