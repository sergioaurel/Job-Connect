<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Champs pour le système de recommandation
            $table->string('diplome_souhaite')->nullable()->after('localisation');
            $table->string('domaine_formation')->nullable()->after('diplome_souhaite');
            $table->string('type_contrat_souhaite')->nullable()->after('domaine_formation');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['diplome_souhaite', 'domaine_formation', 'type_contrat_souhaite']);
        });
    }
};