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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date_naissance');
            $table->string('adresse');
            $table->string('telephone')->unique();
            $table->binary('photo_profil')->nullable();
            $table->binary('photo_permis')->nullable();
            $table->string('numero_permis')->nullable();
            $table->string('numero_voiture')->nullable();
            $table->string('couleur_voiture')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_available')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('role_id')->constrained('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
