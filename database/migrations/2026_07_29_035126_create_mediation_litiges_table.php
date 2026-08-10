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
        Schema::create('mediation_litiges', function (Blueprint $table) {
            $table->id();
            $table->string('nature');
            $table->unsignedInteger('dossiers');
            $table->unsignedInteger('resolus');
            $table->unsignedInteger('taux'); // pourcentage résolus/dossiers
            $table->string('tendance'); // "+12%", "-4%"
            $table->string('tendance_niveau')->default('g'); // g (vert), y (jaune), r (rouge)
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediation_litiges');
    }
};
