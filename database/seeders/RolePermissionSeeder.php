<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // 1. Permissions
        $permissions = [
            // Étudiants
            'voir-etudiants', 'creer-etudiant', 'modifier-etudiant', 'supprimer-etudiant', 'generer-attestation',
            // Inscriptions
            'gerer-inscriptions', 'voir-inscriptions',
            // Paiements
            'voir-paiements', 'valider-paiement', 'annuler-paiement', 'generer-recu', 'gerer-tranches',
            // Notes
            'voir-notes', 'saisir-note', 'modifier-note', 'supprimer-note', 'verrouiller-note', 'generer-pv', 'generer-bulletin',
            // Diplômes/Attestations
            'generer-diplome', 'valider-diplome', 'imprimer-attestation',
            // Rapports/Dashboard
            'voir-rapports', 'voir-dashboard',
            // Enseignants
            'voir-enseignants', 'creer-enseignant', 'modifier-enseignant', 'supprimer-enseignant', 'assigner-matiere',
            // Matières
            'voir-matieres', 'creer-matiere', 'modifier-matiere', 'supprimer-matiere',
            // Classes/Niveaux/Groupes
            'voir-classes', 'creer-classe', 'modifier-classe', 'supprimer-classe',
            // Emploi du temps
            'voir-emplois', 'creer-emploi', 'modifier-emploi', 'supprimer-emploi',
            // Utilisateurs
            'voir-utilisateurs', 'creer-utilisateur', 'modifier-utilisateur', 'supprimer-utilisateur',
            // Paramètres système
            'voir-parametres', 'modifier-parametres', 'modifier-parametres-critiques',
            // Gestion des rôles et permissions
            'voir-roles', 'creer-role', 'modifier-role', 'supprimer-role',
            'voir-permissions', 'creer-permission', 'modifier-permission', 'supprimer-permission',
            // Cycles scolaires
            'voir-cycles', 'creer-cycle', 'modifier-cycle', 'supprimer-cycle',
            // Niveaux scolaires
            'voir-niveaux', 'creer-niveau', 'modifier-niveau', 'supprimer-niveau',
            // Spécialités
            'voir-specialites', 'creer-specialite', 'modifier-specialite', 'supprimer-specialite',
            // Filieres
            'voir-filieres', 'creer-filiere', 'modifier-filiere', 'supprimer-filiere',
            // Années académiques
            'voir-annees', 'creer-annee', 'modifier-annee', 'supprimer-annee',
            // Fonctions
            'voir-fonctions', 'creer-fonction', 'modifier-fonction', 'supprimer-fonction',
            // Disponibilités
            'voir-disponibilites', 'creer-disponibilite', 'modifier-disponibilite', 'supprimer-disponibilite',
            // Affectations
            'voir-affectations', 'creer-affectation', 'modifier-affectation', 'supprimer-affectation',
            // Affectations de niveau
            'voir-affectations-niveau', 'creer-affectation-niveau', 'modifier-affectation-niveau', 'supprimer-affectation-niveau',
            // Enseignement
            'voir-enseignements', 'creer-enseignement', 'modifier-enseignement', 'supprimer-enseignement',
            // Disponibilités des enseignants
            'voir-disponibilites-enseignants', 'creer-disponibilite-enseignant', 'modifier-disponibilite-enseignant', 'supprimer-disponibilite-enseignant',
            // Gestion des ressources
            'voir-ressources', 'creer-ressource', 'modifier-ressource', 'supprimer-ressource',
            // Gestion des notifications
            'voir-notifications', 'creer-notification', 'modifier-notification', 'supprimer-notification',
            // Gestion des logs
            'voir-logs', 'creer-log', 'modifier-log', 'supprimer-log',
            // Gestion des backups
            'voir-backups', 'creer-backup', 'restaurer-backup',
            // Gestion des paramètres avancés
            'voir-parametres-avances', 'modifier-parametres-avances',
            // Gestion des statistiques
            'voir-statistiques', 'generer-statistiques',
            // Gestion des alertes
            'voir-alertes', 'creer-alerte', 'modifier-alerte', 'supprimer-alerte',
            // Gestion des configurations
            'voir-configurations', 'modifier-configuration',
            // etats pdf
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 2. Rôles et attributions des permissions
        $roles = [
            'super_admin' => $permissions,
            'admin' => array_diff($permissions, ['modifier-parametres-critiques']),
            'dg' => [
                'voir-dashboard', 'voir-rapports',
                // Toutes les permissions de lecture
                'voir-etudiants', 'voir-inscriptions', 'voir-paiements', 'voir-notes', 'voir-enseignants',
                'voir-matieres', 'voir-classes', 'voir-emplois', 'voir-utilisateurs', 'voir-parametres',
                'voir-roles', 'voir-permissions', 'voir-cycles', 'voir-niveaux', 'voir-specialites',
                'voir-filieres', 'voir-annees', 'voir-fonctions', 'voir-disponibilites', 'voir-affectations',
                'voir-affectations-niveau', 'voir-enseignements', 'voir-disponibilites-enseignants',
                'voir-ressources', 'voir-notifications', 'voir-logs', 'voir-backups',
                'voir-parametres-avances', 'voir-statistiques', 'voir-alertes',
                'voir-configurations',
            ],
            'secretaire' => [
                'voir-inscriptions', 'gerer-inscriptions',
                'voir-etudiants', 'creer-etudiant', 'modifier-etudiant', 'supprimer-etudiant', 'generer-attestation',
                'voir-paiements', 'valider-paiement', 'generer-recu', 'voir-emplois',
            ],
            'directeur_affaires_academiques' => [
                'voir-notes', 'generer-pv', 'generer-bulletin', 'verrouiller-note',
                'generer-diplome', 'valider-diplome', 'imprimer-attestation', 'voir-rapports',
            ],
            'chef_departement' => [
                'voir-notes', 'saisir-note', 'modifier-note', 'verrouiller-note',
                'voir-etudiants', 'voir-enseignants',
            ],
            'responsable_niveau' => [
                'voir-notes', 'saisir-note', 'modifier-note', 'verrouiller-note',
                'voir-etudiants',
            ],
            'enseignant' => [
                'voir-notes', 'saisir-note', 'modifier-note', 'voir-matieres', 'voir-emplois',
            ],
            'etudiant' => [
                'voir-notes', 'generer-bulletin', 'imprimer-attestation', 'voir-paiements', 'generer-recu',
            ],
            'comptable' => [
                'voir-paiements', 'valider-paiement', 'annuler-paiement', 'generer-recu', 'gerer-tranches', 'voir-etudiants', 'voir-rapports',
            ],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        // 3. Création du super_admin par défaut (si besoin)
        $superAdmin = User::firstOrCreate(
                ['email' => 'alphedtatong@gmail.com'],
                [
                    'login' => 'superadmin',
                    'name' => 'Super Admin',
                    'password' => bcrypt('31072002'), // Change ce mot de passe après le seed!
                ]
            );

        $superAdmin->assignRole('super_admin');
    }
}
