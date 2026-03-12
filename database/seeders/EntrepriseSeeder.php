<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les utilisateurs de type entreprise
        $userEntreprises = User::where('role', 'entreprise')->get();

        // Entreprise 1: TechSolutions Bénin
        if ($userEntreprises->count() > 0) {
            Entreprise::create([
                'user_id' => $userEntreprises[0]->id,
                'nom_entreprise' => 'TechSolutions Bénin',
                'description' => 'Entreprise spécialisée dans le développement de solutions digitales pour les entreprises béninoises. Nous offrons des services de développement web, mobile et de conseil en transformation digitale.',
                'secteur_activite' => 'Informatique et Technologies',
                'site_web' => 'https://www.techsolutions.bj',
                'adresse' => 'Rue 123, Akpakpa',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 30 45 67',
                'effectif' => 25,
                'annee_creation' => 2018,
                'statut' => 'validee',
            ]);
        }

        // Entreprise 2: Cabinet Expertise Comptable
        if ($userEntreprises->count() > 1) {
            Entreprise::create([
                'user_id' => $userEntreprises[1]->id,
                'nom_entreprise' => 'Cabinet Expertise Comptable & Audit',
                'description' => 'Cabinet d\'expertise comptable offrant des services de comptabilité, audit, conseil fiscal et accompagnement des entreprises dans leur gestion financière.',
                'secteur_activite' => 'Finance et Comptabilité',
                'site_web' => 'https://www.expertise-compta.bj',
                'adresse' => 'Avenue Steinmetz, Quartier des Affaires',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 52 89',
                'effectif' => 15,
                'annee_creation' => 2015,
                'statut' => 'validee',
            ]);
        }

        // Entreprise 3: AgriVert Bénin
        if ($userEntreprises->count() > 2) {
            Entreprise::create([
                'user_id' => $userEntreprises[2]->id,
                'nom_entreprise' => 'AgriVert Bénin SARL',
                'description' => 'Entreprise agricole moderne spécialisée dans la production de fruits et légumes bio. Nous contribuons à la sécurité alimentaire au Bénin tout en respectant l\'environnement.',
                'secteur_activite' => 'Agriculture et Environnement',
                'site_web' => null,
                'adresse' => 'Zone Agricole, BP 456',
                'ville' => 'Parakou',
                'telephone_entreprise' => '+229 97 45 23 18',
                'effectif' => 50,
                'annee_creation' => 2019,
                'statut' => 'validee',
            ]);
        }
    }
}