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
        Schema::create('arret_trajet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trajet_id');
            $table->unsignedBigInteger('arret_id');
            $table->is_string('ordre');
            $table->foreign('trajet_id')->references('id')->on('trajets')->onDelete('cascade');
            $table->foreign('arret_id')->references('id')->on('arrets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrets_trajets');
    }
};
