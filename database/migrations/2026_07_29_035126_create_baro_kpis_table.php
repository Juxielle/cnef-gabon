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
        Schema::create('baro_kpis', function (Blueprint $table) {
            $table->id();
            $table->string('secteur'); // PIB, Inflation, Bancaire, Inclusion, Solv., Chômage
            $table->string('valeur');
            $table->string('unite');
            $table->string('libelle');
            $table->string('delta');
            $table->string('tendance')->default('up'); // up, dn, neu
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baro_kpis');
    }
};
