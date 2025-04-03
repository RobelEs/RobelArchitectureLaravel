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
        Schema::create('chantier_employe', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // $table->foreign('chantier_id')->references('id')->on('chantiers');
            $table->foreignId('chantier_id')->constrained('chantiers'); 
            $table->foreignId('employe_id')->constrained('users'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chantier_employe');
    }
};
