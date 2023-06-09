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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('pseudo')->unique();
            $table->ipAddress('mail')->unique();
            $table->ipAddress('mdp');
            $table->string('signe_zodiaque');
            $table->string('signe_chinois');
            $table->tinyInteger('jour');
            $table->tinyInteger('mois');
            $table->smallInteger('annee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
