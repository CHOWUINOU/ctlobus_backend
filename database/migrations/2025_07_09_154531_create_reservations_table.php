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
         Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_place');
            $table->decimal('prix_payer', 8, 2);
            $table->string('statut');
            $table->string('type_reservation');
            $table->dateTime('date_reservation');
            $table->dateTime('date_expiration');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('voyage_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('voyage_id')->references('id')->on('voyages')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
