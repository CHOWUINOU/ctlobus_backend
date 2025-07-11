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
        Schema::create('agences', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('ville');
    $table->string('adresse');
    $table->string('telephone');
    $table->enum('statut', ['Actif', 'suspendu']);
    $table->date('abonnement_debut');
    $table->date('abonnement_fin');
    $table->string('horaire_ouverture');
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agences');
    }
};
