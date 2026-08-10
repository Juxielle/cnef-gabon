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
        Schema::create('texte_reglementaires', function (Blueprint $table) {
            $table->id();
            $table->string('categorie'); // fondateurs, mediation, cobac, cosumaf, cima, lbc, teg
            $table->string('type'); // Règlement CEMAC, Décret, Arrêté MEP, ...
            $table->string('reference');
            $table->string('titre');
            $table->text('description');
            $table->string('date_publication'); // texte libre ("12 décembre 2019")
            $table->string('fichier')->nullable(); // nom du document dans public/assets/documents
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texte_reglementaires');
    }
};
