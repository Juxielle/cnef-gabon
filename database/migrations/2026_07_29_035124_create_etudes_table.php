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
        Schema::create('etudes', function (Blueprint $table) {
            $table->id();
            $table->string('categorie'); // Rapport annuel, Note de conjoncture, ...
            $table->string('titre');
            $table->text('description');
            $table->json('kpis'); // [{v: '8,4%', l: 'Croissance actifs'}, ...]
            $table->string('date_publication');
            $table->unsignedInteger('nombre_pages')->nullable();
            $table->string('fichier')->nullable();
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudes');
    }
};
