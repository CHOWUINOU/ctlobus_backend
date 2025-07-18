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
       Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation');
            $table->string('marque');
            $table->string('statut');
            $table->integer('nbre_places');
            $table->unsignedBigInteger('filiale_id');
            $table->foreign('filiale_id')->references('id')->on('filiales')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
