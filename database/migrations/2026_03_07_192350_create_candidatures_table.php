<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('lettre_motivation');
            $table->string('cv_path')->nullable();
            $table->enum('statut', ['en_attente', 'vue', 'retenue', 'rejetee'])->default('en_attente');
            $table->text('note_recruteur')->nullable();
            $table->timestamp('vue_le')->nullable();
            $table->timestamps();
            
            // Un candidat ne peut postuler qu'une fois à une offre
            $table->unique(['offre_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};