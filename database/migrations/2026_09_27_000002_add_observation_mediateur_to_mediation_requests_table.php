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
        Schema::table('mediation_requests', function (Blueprint $table) {
            $table->text('observation_mediateur')->nullable()->after('statut');
            $table->timestamp('date_traitement')->nullable()->after('observation_mediateur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mediation_requests', function (Blueprint $table) {
            $table->dropColumn(['observation_mediateur', 'date_traitement']);
        });
    }
};
