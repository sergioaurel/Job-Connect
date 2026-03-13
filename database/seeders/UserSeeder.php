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
        // ═══════════════════════════════════════
        // 1. ADMINISTRATEUR
        // ═══════════════════════════════════════
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@plateforme-emploi.bj',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'telephone' => '+229 97 00 00 00',
            'localisation' => 'Cotonou',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // ═══════════════════════════════════════
        // 2. ENTREPRISES (23 au total)
        // ═══════════════════════════════════════
        $entreprisesData = [
            ['name' => 'TechSolutions Bénin', 'email' => 'contact@techsolutions.bj', 'tel' => '+229 21 30 45 67', 'ville' => 'Cotonou'],
            ['name' => 'Cabinet Expertise Comptable', 'email' => 'contact@expertise-compta.bj', 'tel' => '+229 21 31 52 89', 'ville' => 'Cotonou'],
            ['name' => 'AgriVert Bénin', 'email' => 'info@agrivert.bj', 'tel' => '+229 97 45 23 18', 'ville' => 'Parakou'],
            ['name' => 'Orange Bénin', 'email' => 'rh@orange.bj', 'tel' => '+229 21 36 00 00', 'ville' => 'Cotonou'],
            ['name' => 'MTN Bénin', 'email' => 'recrutement@mtn.bj', 'tel' => '+229 21 37 00 00', 'ville' => 'Cotonou'],
            ['name' => 'BSIC Bénin', 'email' => 'rh@bsic.bj', 'tel' => '+229 21 31 20 00', 'ville' => 'Cotonou'],
            ['name' => 'Orabank Bénin', 'email' => 'jobs@orabank.bj', 'tel' => '+229 21 31 30 00', 'ville' => 'Cotonou'],
            ['name' => 'Ecobank Bénin', 'email' => 'recrutement@ecobank.bj', 'tel' => '+229 21 31 40 00', 'ville' => 'Cotonou'],
            ['name' => 'Cabinet Juridique Akpovi', 'email' => 'contact@akpovi-juridique.bj', 'tel' => '+229 97 12 34 56', 'ville' => 'Cotonou'],
            ['name' => 'Clinique Sainte Marie', 'email' => 'rh@clinique-saintemarie.bj', 'tel' => '+229 21 32 10 00', 'ville' => 'Cotonou'],
            ['name' => 'Groupe Scolaire Excellence', 'email' => 'direction@excellence.bj', 'tel' => '+229 97 55 66 77', 'ville' => 'Cotonou'],
            ['name' => 'BTP Construct Bénin', 'email' => 'rh@btpconstruct.bj', 'tel' => '+229 96 44 55 66', 'ville' => 'Cotonou'],
            ['name' => 'LogisTrans Bénin', 'email' => 'emploi@logistrans.bj', 'tel' => '+229 97 33 44 55', 'ville' => 'Cotonou'],
            ['name' => 'Hôtel Azalaï', 'email' => 'rh@azalai.bj', 'tel' => '+229 21 30 10 00', 'ville' => 'Cotonou'],
            ['name' => 'Agence Digitale BeninWeb', 'email' => 'jobs@beninweb.bj', 'tel' => '+229 96 78 90 12', 'ville' => 'Cotonou'],
            ['name' => 'SONEB', 'email' => 'recrutement@soneb.bj', 'tel' => '+229 21 31 00 00', 'ville' => 'Cotonou'],
            ['name' => 'SBEE', 'email' => 'rh@sbee.bj', 'tel' => '+229 21 31 11 00', 'ville' => 'Cotonou'],
            ['name' => 'Pharmacie Centrale Bénin', 'email' => 'emploi@pharmaciecentrale.bj', 'tel' => '+229 21 31 22 00', 'ville' => 'Cotonou'],
            ['name' => 'Studio Créatif Voodoo', 'email' => 'hello@voodoo-studio.bj', 'tel' => '+229 96 11 22 33', 'ville' => 'Cotonou'],
            ['name' => 'AssuriBénin', 'email' => 'rh@assuribenin.bj', 'tel' => '+229 21 31 55 00', 'ville' => 'Cotonou'],
            ['name' => 'FoodTech Bénin', 'email' => 'jobs@foodtech.bj', 'tel' => '+229 97 99 88 77', 'ville' => 'Porto-Novo'],
            ['name' => 'EnergieSolaire BJ', 'email' => 'recrutement@energiesolaire.bj', 'tel' => '+229 96 55 44 33', 'ville' => 'Parakou'],
            ['name' => 'MicroFinance Alafia', 'email' => 'rh@alafia.bj', 'tel' => '+229 21 32 20 00', 'ville' => 'Abomey-Calavi'],
        ];

        foreach ($entreprisesData as $e) {
            User::create([
                'name' => $e['name'],
                'email' => $e['email'],
                'password' => Hash::make('password'),
                'role' => 'entreprise',
                'telephone' => $e['tel'],
                'localisation' => $e['ville'],
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }

        // ═══════════════════════════════════════
        // 3. CANDIDATS (18 au total)
        // ═══════════════════════════════════════
        $candidatsData = [
            ['name' => 'Jean-Baptiste AKPLOGAN', 'email' => 'jb.akplogan@gmail.com', 'tel' => '+229 96 12 34 56', 'ville' => 'Cotonou'],
            ['name' => 'Marie DOSSOU', 'email' => 'marie.dossou@yahoo.fr', 'tel' => '+229 97 88 99 00', 'ville' => 'Porto-Novo'],
            ['name' => 'Rodrigue KPOGNON', 'email' => 'r.kpognon@student.uac.bj', 'tel' => '+229 94 56 78 90', 'ville' => 'Abomey-Calavi'],
            ['name' => 'Fidèle AHOUANSOU', 'email' => 'fidele.ahouansou@gmail.com', 'tel' => '+229 96 23 45 67', 'ville' => 'Cotonou'],
            ['name' => 'Raïssa GBAGUIDI', 'email' => 'raissa.gbaguidi@gmail.com', 'tel' => '+229 97 34 56 78', 'ville' => 'Cotonou'],
            ['name' => 'Arnaud HOUNKPONOU', 'email' => 'arnaud.hounkponou@gmail.com', 'tel' => '+229 96 45 67 89', 'ville' => 'Parakou'],
            ['name' => 'Christelle AGOSSA', 'email' => 'christelle.agossa@gmail.com', 'tel' => '+229 97 56 78 90', 'ville' => 'Cotonou'],
            ['name' => 'Wilfried AZONDEKON', 'email' => 'wilfried.azondekon@gmail.com', 'tel' => '+229 94 67 89 01', 'ville' => 'Abomey-Calavi'],
            ['name' => 'Sandrine TOKPO', 'email' => 'sandrine.tokpo@yahoo.fr', 'tel' => '+229 96 78 90 12', 'ville' => 'Cotonou'],
            ['name' => 'Cyrille ADANWENON', 'email' => 'cyrille.adanwenon@gmail.com', 'tel' => '+229 97 89 01 23', 'ville' => 'Porto-Novo'],
            ['name' => 'Nadège HOUNSA', 'email' => 'nadege.hounsa@gmail.com', 'tel' => '+229 96 90 12 34', 'ville' => 'Cotonou'],
            ['name' => 'Brice OSSE', 'email' => 'brice.osse@gmail.com', 'tel' => '+229 94 01 23 45', 'ville' => 'Cotonou'],
            ['name' => 'Vanessa ADOMOU', 'email' => 'vanessa.adomou@gmail.com', 'tel' => '+229 97 12 34 56', 'ville' => 'Abomey-Calavi'],
            ['name' => 'Franck HOUNSOU', 'email' => 'franck.hounsou@gmail.com', 'tel' => '+229 96 23 45 67', 'ville' => 'Parakou'],
            ['name' => 'Pélagie LOKO', 'email' => 'pelagie.loko@gmail.com', 'tel' => '+229 97 34 56 78', 'ville' => 'Cotonou'],
            ['name' => 'Roméo GNIMADI', 'email' => 'romeo.gnimadi@gmail.com', 'tel' => '+229 94 45 67 89', 'ville' => 'Cotonou'],
            ['name' => 'Aurélie ASSOGBA', 'email' => 'aurelie.assogba@gmail.com', 'tel' => '+229 96 56 78 90', 'ville' => 'Porto-Novo'],
            ['name' => 'Maxime VODOUNON', 'email' => 'maxime.vodounon@gmail.com', 'tel' => '+229 97 67 89 01', 'ville' => 'Cotonou'],
        ];

        $candidats = [];
        foreach ($candidatsData as $c) {
            $candidats[] = User::create([
                'name' => $c['name'],
                'email' => $c['email'],
                'password' => Hash::make('password'),
                'role' => 'candidat',
                'telephone' => $c['tel'],
                'localisation' => $c['ville'],
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Expériences et formations pour les candidats
        $experiencesData = [
            ['poste' => 'Développeur Web Junior', 'entreprise' => 'Digital Agency BJ', 'ville' => 'Cotonou', 'debut' => '2022-03-01', 'fin' => '2023-12-31', 'en_cours' => false, 'desc' => 'Développement de sites web avec Laravel et Vue.js'],
            ['poste' => 'Assistante Comptable', 'entreprise' => 'Cabinet COMPTA+', 'ville' => 'Porto-Novo', 'debut' => '2020-09-01', 'fin' => null, 'en_cours' => true, 'desc' => 'Gestion comptable, déclarations fiscales, suivi trésorerie'],
            ['poste' => 'Chargé Marketing Digital', 'entreprise' => 'StartUp BJ', 'ville' => 'Cotonou', 'debut' => '2021-06-01', 'fin' => '2023-05-31', 'en_cours' => false, 'desc' => 'Gestion des réseaux sociaux et campagnes publicitaires'],
            ['poste' => 'Développeur Full Stack', 'entreprise' => 'TechBénin SARL', 'ville' => 'Cotonou', 'debut' => '2023-01-01', 'fin' => null, 'en_cours' => true, 'desc' => 'Développement d\'applications web avec Laravel et React'],
            ['poste' => 'Analyste Financier', 'entreprise' => 'Banque BOA', 'ville' => 'Cotonou', 'debut' => '2019-09-01', 'fin' => '2022-08-31', 'en_cours' => false, 'desc' => 'Analyse des risques et reporting financier'],
            ['poste' => 'Infirmier Diplômé', 'entreprise' => 'Clinique Les Cocotiers', 'ville' => 'Cotonou', 'debut' => '2020-03-01', 'fin' => null, 'en_cours' => true, 'desc' => 'Soins aux patients, urgences, pédiatrie'],
            ['poste' => 'Enseignant Vacataire', 'entreprise' => 'Lycée Technique de Cotonou', 'ville' => 'Cotonou', 'debut' => '2021-09-01', 'fin' => '2023-06-30', 'en_cours' => false, 'desc' => 'Enseignement informatique et mathématiques'],
            ['poste' => 'Commercial Terrain', 'entreprise' => 'Orange Bénin', 'ville' => 'Parakou', 'debut' => '2022-01-01', 'fin' => null, 'en_cours' => true, 'desc' => 'Vente de produits et services télécom'],
            ['poste' => 'Graphiste', 'entreprise' => 'Agence Créative Cotonou', 'ville' => 'Cotonou', 'debut' => '2020-06-01', 'fin' => '2022-12-31', 'en_cours' => false, 'desc' => 'Création de supports visuels et identités visuelles'],
            ['poste' => 'Juriste d\'Entreprise', 'entreprise' => 'Cabinet Akpovi', 'ville' => 'Cotonou', 'debut' => '2021-01-01', 'fin' => null, 'en_cours' => true, 'desc' => 'Rédaction de contrats et conseil juridique'],
        ];

        $formationsData = [
            ['diplome' => 'Licence en Informatique', 'etablissement' => 'UAC', 'domaine' => 'Génie Logiciel', 'annee' => 2021],
            ['diplome' => 'BTS Comptabilité Gestion', 'etablissement' => 'ESTIM', 'domaine' => 'Comptabilité', 'annee' => 2020],
            ['diplome' => 'Licence en Marketing', 'etablissement' => 'FASEG', 'domaine' => 'Marketing', 'annee' => 2021],
            ['diplome' => 'Master Développement Web', 'etablissement' => 'IFRI', 'domaine' => 'Technologies Web', 'annee' => 2023],
            ['diplome' => 'Master Finance', 'etablissement' => 'FASEG - UAC', 'domaine' => 'Finance d\'entreprise', 'annee' => 2019],
            ['diplome' => 'BTS Soins Infirmiers', 'etablissement' => 'ISBA', 'domaine' => 'Sciences de la Santé', 'annee' => 2019],
            ['diplome' => 'Licence en Mathématiques', 'etablissement' => 'FAST - UAC', 'domaine' => 'Mathématiques Appliquées', 'annee' => 2020],
            ['diplome' => 'BTS Commerce', 'etablissement' => 'ESAG-NDE', 'domaine' => 'Commerce et Vente', 'annee' => 2021],
            ['diplome' => 'Licence Art et Design', 'etablissement' => 'INJEPS', 'domaine' => 'Design Graphique', 'annee' => 2020],
            ['diplome' => 'Master Droit des Affaires', 'etablissement' => 'FADESP - UAC', 'domaine' => 'Droit', 'annee' => 2021],
            ['diplome' => 'Licence Gestion RH', 'etablissement' => 'ESGIS', 'domaine' => 'Ressources Humaines', 'annee' => 2022],
            ['diplome' => 'BTS Informatique', 'etablissement' => 'IPNET', 'domaine' => 'Développement Logiciel', 'annee' => 2022],
            ['diplome' => 'Licence Logistique', 'etablissement' => 'ESTIM', 'domaine' => 'Transport et Logistique', 'annee' => 2021],
            ['diplome' => 'BTS Hôtellerie Restauration', 'etablissement' => 'Institut Hôtelier de Cotonou', 'domaine' => 'Hôtellerie', 'annee' => 2020],
            ['diplome' => 'Licence Agronomie', 'etablissement' => 'FSA - UAC', 'domaine' => 'Agriculture', 'annee' => 2022],
            ['diplome' => 'Master Génie Civil', 'etablissement' => 'EPAC - UAC', 'domaine' => 'BTP', 'annee' => 2021],
            ['diplome' => 'Licence Communication', 'etablissement' => 'FADESP', 'domaine' => 'Communication', 'annee' => 2023],
            ['diplome' => 'BTS Banque Assurance', 'etablissement' => 'CESAG', 'domaine' => 'Banque et Finance', 'annee' => 2022],
        ];

        foreach ($candidats as $index => $candidat) {
            // Formation principale
            if (isset($formationsData[$index])) {
                $f = $formationsData[$index];
                Formation::create([
                    'user_id' => $candidat->id,
                    'diplome' => $f['diplome'],
                    'etablissement' => $f['etablissement'],
                    'domaine' => $f['domaine'],
                    'annee_obtention' => $f['annee'],
                ]);
            }

            // Expérience principale
            if (isset($experiencesData[$index % count($experiencesData)])) {
                $e = $experiencesData[$index % count($experiencesData)];
                Experience::create([
                    'user_id' => $candidat->id,
                    'poste' => $e['poste'],
                    'entreprise' => $e['entreprise'],
                    'ville' => $e['ville'],
                    'date_debut' => $e['debut'],
                    'date_fin' => $e['fin'],
                    'en_cours' => $e['en_cours'],
                    'description' => $e['desc'],
                ]);
            }

            // Compétences aléatoires selon le profil
            $competencesSets = [
                ['PHP', 'Laravel', 'JavaScript', 'MySQL', 'Git'],
                ['Comptabilité générale', 'Excel avancé', 'Sage', 'Fiscalité'],
                ['Social Media Marketing', 'Canva', 'Communication écrite'],
                ['React', 'Node.js', 'TypeScript', 'MongoDB'],
                ['Analyse financière', 'Excel avancé', 'PowerPoint'],
                ['Communication écrite', 'Créativité', 'Travail en équipe'],
            ];

            $set = $competencesSets[$index % count($competencesSets)];
            $niveaux = ['debutant', 'intermediaire', 'avance'];
            $niveau = $niveaux[$index % 3];

            $competences = Competence::whereIn('nom', $set)->get();
            foreach ($competences as $competence) {
                $candidat->competences()->attach($competence->id, ['niveau' => $niveau]);
            }
        }
    }
}