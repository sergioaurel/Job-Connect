<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ajoute la valeur 'suspendue' à l'enum statut de la table entreprises.
     * Nécessaire pour refléter visuellement la suspension dans l'interface admin.
     */
    public function up(): void
    {
        // MySQL : modifier un ENUM nécessite de redéfinir toutes ses valeurs
        DB::statement("ALTER TABLE entreprises MODIFY COLUMN statut ENUM('en_attente', 'validee', 'rejetee', 'suspendue') NOT NULL DEFAULT 'en_attente'");
    }

    public function down(): void
    {
        // Remettre les entreprises suspendues en attente avant de retirer la valeur
        DB::statement("UPDATE entreprises SET statut = 'en_attente' WHERE statut = 'suspendue'");
        DB::statement("ALTER TABLE entreprises MODIFY COLUMN statut ENUM('en_attente', 'validee', 'rejetee') NOT NULL DEFAULT 'en_attente'");
    }
};
