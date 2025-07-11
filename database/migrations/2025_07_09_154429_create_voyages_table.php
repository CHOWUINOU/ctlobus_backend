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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->date('date_voyage');
            $table->time('heure_depart');
            $table->time('heure_arrivee');
            $table->string('statut');
            $table->integer('place_disponible');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('trajet_id');
            $table->unsignedBigInteger('chauffeur_id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('trajet_id')->references('id')->on('trajets')->onDelete('cascade');
            $table->foreign('chauffeur_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
