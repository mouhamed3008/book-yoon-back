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
            $table->string('depart', 255);
            $table->string('destination', 255);
            $table->dateTime('DateParcours');
            $table->string('heureParcours', 255);
            $table->integer('prixPayment');
            $table->string('itineraires');
            $table->boolean('is_active')->default(1);
            $table->string('payerPar')->nullable();
            $table->foreignId('passager_id')->nullable()->constrained('users');
            $table->foreignId('conducteur_id')->nullable()->constrained('users');
            $table->timestamps();
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
