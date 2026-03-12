<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidat_competence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('competence_id')->constrained()->onDelete('cascade');
            $table->enum('niveau', ['debutant', 'intermediaire', 'avance', 'expert'])->default('intermediaire');
            $table->timestamps();
            
            // Un candidat ne peut avoir la même compétence qu'une fois
            $table->unique(['user_id', 'competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidat_competence');
    }
};