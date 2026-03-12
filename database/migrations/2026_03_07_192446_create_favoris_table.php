<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Un candidat ne peut ajouter qu'une fois une offre en favori
            $table->unique(['user_id', 'offre_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoris');
    }
};