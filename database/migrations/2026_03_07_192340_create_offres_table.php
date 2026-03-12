<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->string('slug')->unique();
            $table->enum('type_offre', ['emploi', 'stage_professionnel', 'stage_academique']);
            $table->enum('type_contrat', ['CDI', 'CDD', 'temps_partiel', 'freelance', 'stage'])->nullable();
            $table->text('description');
            $table->text('missions');
            $table->text('profil_recherche');
            $table->text('competences_requises')->nullable();
            $table->string('niveau_etude')->nullable();
            $table->integer('annees_experience')->default(0);
            $table->string('ville');
            $table->string('salaire_min')->nullable();
            $table->string('salaire_max')->nullable();
            $table->boolean('salaire_a_negocier')->default(false);
            $table->integer('nombre_postes')->default(1);
            $table->date('date_limite')->nullable();
            $table->enum('statut', ['active', 'fermee', 'pourvue'])->default('active');
            $table->integer('vues')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};