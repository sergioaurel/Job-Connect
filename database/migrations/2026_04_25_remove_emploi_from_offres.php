<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── Étape 1 : Supprimer les offres de type emploi ──
        DB::table('offres')->where('type_offre', 'emploi')->delete();

        // ── Étape 2 : Modifier l'enum type_offre (MySQL) ──
        DB::statement("ALTER TABLE offres MODIFY COLUMN type_offre ENUM('stage_professionnel','stage_academique') NOT NULL");

        // ── Étape 3 : Vider type_contrat sur toutes les offres restantes ──
        // (les stages n'ont pas besoin de CDI/CDD/freelance)
        DB::table('offres')->update(['type_contrat' => null]);

        // ── Étape 4 : Adapter l'enum type_contrat ──
        // On garde uniquement 'stage' pour d'éventuels usages futurs
        DB::statement("ALTER TABLE offres MODIFY COLUMN type_contrat ENUM('stage') NULL DEFAULT NULL");

        // ── Étape 5 : Adapter type_contrat_souhaite dans users ──
        DB::table('users')
            ->whereIn('type_contrat_souhaite', ['CDI', 'CDD', 'temps_partiel', 'freelance'])
            ->update(['type_contrat_souhaite' => null]);
    }

    public function down(): void
    {
        // Restaurer les enums originaux
        DB::statement("ALTER TABLE offres MODIFY COLUMN type_offre ENUM('emploi','stage_professionnel','stage_academique') NOT NULL");
        DB::statement("ALTER TABLE offres MODIFY COLUMN type_contrat ENUM('CDI','CDD','temps_partiel','freelance','stage') NULL DEFAULT NULL");
    }
};