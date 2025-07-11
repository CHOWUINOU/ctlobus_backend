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
       Schema::create('filiales', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('ville');
    $table->string('adresse');
    $table->string('telephone');
    $table->string('email');
    $table->string('logo')->nullable();
    $table->unsignedBigInteger('agence_id');
    $table->foreign('agence_id')->references('id')->on('agences')->onDelete('cascade');
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiales');
    }
};
