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
        Schema::create('chantier_materiel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('materiel_id');
            $table->integer('quantite_utilisee');
            $table->timestamps();

            $table->foreign('chantier_id')->references('id')->on('chantiers');
            $table->foreign('materiel_id')->references('id')->on('materiels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chantier_materiel');
    }
};
