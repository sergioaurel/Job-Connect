<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Competence;
use App\Models\Experience;
use App\Models\Formation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer un administrateur
        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@plateforme-emploi.bj',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'telephone' => '+229 97 00 00 00',
            'localisation' => 'Cotonou',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // 2. Créer des entreprises (utilisateurs)
        $entreprise1 = User::create([
            'name' => 'TechSolutions Bénin',
            'email' => 'contact@techsolutions.bj',
            'password' => Hash::make('password'),
            'role' => 'entreprise',
            'telephone' => '+229 21 30 45 67',
            'localisation' => 'Cotonou',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $entreprise2 = User::create([
            'name' => 'Cabinet Expertise Comptable',
            'email' => 'contact@expertise-compta.bj',
            'password' => Hash::make('password'),
            'role' => 'entreprise',
            'telephone' => '+229 21 31 52 89',
            'localisation' => 'Cotonou',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $entreprise3 = User::create([
            'name' => 'AgriVert Bénin',
            'email' => 'info@agrivert.bj',
            'password' => Hash::make('password'),
            'role' => 'entreprise',
            'telephone' => '+229 97 45 23 18',
            'localisation' => 'Parakou',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // 3. Créer des candidats
        $candidat1 = User::create([
            'name' => 'Jean-Baptiste AKPLOGAN',
            'email' => 'jb.akplogan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'candidat',
            'telephone' => '+229 96 12 34 56',
            'localisation' => 'Cotonou',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Ajouter expériences pour candidat1
        Experience::create([
            'user_id' => $candidat1->id,
            'poste' => 'Développeur Web Junior',
            'entreprise' => 'Digital Agency BJ',
            'ville' => 'Cotonou',
            'date_debut' => '2022-03-01',
            'date_fin' => '2023-12-31',
            'en_cours' => false,
            'description' => 'Développement de sites web avec Laravel et Vue.js',
        ]);

        Experience::create([
            'user_id' => $candidat1->id,
            'poste' => 'Développeur Full Stack',
            'entreprise' => 'StartUp Tech',
            'ville' => 'Cotonou',
            'date_debut' => '2024-01-15',
            'date_fin' => null,
            'en_cours' => true,
            'description' => 'Développement d\'applications web et maintenance',
        ]);

        // Ajouter formations pour candidat1
        Formation::create([
            'user_id' => $candidat1->id,
            'diplome' => 'Licence en Informatique',
            'etablissement' => 'Université d\'Abomey-Calavi',
            'domaine' => 'Génie Logiciel',
            'annee_obtention' => 2021,
        ]);

        Formation::create([
            'user_id' => $candidat1->id,
            'diplome' => 'Master en Développement Web',
            'etablissement' => 'IFRI',
            'domaine' => 'Technologies Web',
            'annee_obtention' => 2023,
        ]);

        // Ajouter compétences pour candidat1
        $competencesCandidat1 = Competence::whereIn('nom', [
            'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'MySQL', 'Git', 'HTML/CSS'
        ])->get();

        foreach ($competencesCandidat1 as $competence) {
            $candidat1->competences()->attach($competence->id, [
                'niveau' => 'avance',
            ]);
        }

        // Candidat 2
        $candidat2 = User::create([
            'name' => 'Marie DOSSOU',
            'email' => 'marie.dossou@yahoo.fr',
            'password' => Hash::make('password'),
            'role' => 'candidat',
            'telephone' => '+229 97 88 99 00',
            'localisation' => 'Porto-Novo',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Expérience candidat2
        Experience::create([
            'user_id' => $candidat2->id,
            'poste' => 'Assistante Comptable',
            'entreprise' => 'Cabinet COMPTA+',
            'ville' => 'Porto-Novo',
            'date_debut' => '2020-09-01',
            'date_fin' => null,
            'en_cours' => true,
            'description' => 'Gestion comptable, déclarations fiscales, suivi trésorerie',
        ]);

        // Formation candidat2
        Formation::create([
            'user_id' => $candidat2->id,
            'diplome' => 'BTS Comptabilité Gestion',
            'etablissement' => 'ESTIM',
            'domaine' => 'Comptabilité',
            'annee_obtention' => 2020,
        ]);

        // Compétences candidat2
        $competencesCandidat2 = Competence::whereIn('nom', [
            'Comptabilité générale', 'Excel avancé', 'Sage', 'Fiscalité'
        ])->get();

        foreach ($competencesCandidat2 as $competence) {
            $candidat2->competences()->attach($competence->id, [
                'niveau' => 'intermediaire',
            ]);
        }

        // Candidat 3 (étudiant cherchant stage)
        $candidat3 = User::create([
            'name' => 'Rodrigue KPOGNON',
            'email' => 'r.kpognon@student.uac.bj',
            'password' => Hash::make('password'),
            'role' => 'candidat',
            'telephone' => '+229 94 56 78 90',
            'localisation' => 'Abomey-Calavi',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Formation candidat3
        Formation::create([
            'user_id' => $candidat3->id,
            'diplome' => 'Licence en cours - Marketing',
            'etablissement' => 'FASEG - UAC',
            'domaine' => 'Marketing et Communication',
            'annee_obtention' => 2026,
        ]);

        // Compétences candidat3
        $competencesCandidat3 = Competence::whereIn('nom', [
            'Social Media Marketing', 'Canva', 'Communication écrite', 'Créativité'
        ])->get();

        foreach ($competencesCandidat3 as $competence) {
            $candidat3->competences()->attach($competence->id, [
                'niveau' => 'debutant',
            ]);
        }
    }
}