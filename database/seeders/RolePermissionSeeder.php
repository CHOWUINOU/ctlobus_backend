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
            // Agences
            'voir-agence', 'creer-agence', 'modifier-agence', 'supprimer-agence',
            //Filiales
            'voir-filiale', 'creer-filiale', 'modifier-filiale', 'supprimer-filiale',

            // Utilisateurs
            'voir-utilisateurs', 'creer-utilisateur', 'modifier-utilisateur', 'supprimer-utilisateur',

            // Bus
            'voir-bus', 'creer-bus', 'modifier-bus', 'supprimer-bus',

            // Chauffeurs
            'voir-chauffeur', 'creer-chauffeur', 'modifier-chauffeur', 'supprimer-chauffeur' , 'voir-trajet', 'voir-voyage',

            // Guichets
            'voir-guichet', 'creer-guichet', 'modifier-guichet', 'supprimer-guichet',

            // Trajets et  (gestion conjointe)
            'voir-trajet', 'creer-trajet', 'modifier-trajet', 'supprimer-trajet',

            //Arrêts
            'voir-arret', 'creer-arret', 'modifier-arret', 'supprimer-arret',

            // associer/dissocier plusieurs arrêts à un trajet
            'gerer-arrets-sur-trajet',

            // Réservations
            'voir-reservation', 'creer-reservation', 'modifier-reservation', 'annuler-reservation',

            // Paiements
            'voir-paiement', 'valider-paiement', 'annuler-paiement',

            // Profils
            'consulter-profil', 'modifier-profil',

            //Dashboard
            'voir-rapports', 'voir-dashboard',
        ];


        // Création ou mise à jour des permissions en base
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 2. Rôles et attributions des permissions
        $roles = [
            'super_admin' => $permissions,

            'admin_agence' => [
                array_diff($permissions, ['modifier-parametres-critiques']),


                // Gestion filiales
                'voir-filiale', 'creer-filiale', 'modifier-filiale', 'supprimer-filiale',
                // Gestion utilisateurs (chefs filiales, guichets, chauffeurs)
                'voir-utilisateurs', 'creer-utilisateur', 'modifier-utilisateur', 'supprimer-utilisateur',
                // Gestion bus
                'voir-bus', 'creer-bus', 'modifier-bus', 'supprimer-bus',
                // Gestion chauffeurs
                'voir-chauffeur', 'creer-chauffeur', 'modifier-chauffeur', 'supprimer-chauffeur','voir-trajet', 'voir-voyage',
                // Gestion guichets
                'voir-guichet', 'creer-guichet', 'modifier-guichet', 'supprimer-guichet',
                // Gestion trajets et arrêts
                'voir-trajet', 'creer-trajet', 'modifier-trajet', 'supprimer-trajet',
                'voir-arret', 'creer-arret', 'modifier-arret', 'supprimer-arret',
                'gerer-arrets-sur-trajet',
                // Réservations et paiements
                'voir-reservation', 'creer-reservation', 'modifier-reservation', 'annuler-reservation',
                'voir-paiement', 'valider-paiement', 'annuler-paiement',
                // Rapports & dashboard
                'voir-rapports', 'voir-dashboard',
            ],

            'chef_filiale' => [
                // Gestion limitée à la filiale
                'voir-filiale', 'modifier-filiale',

                // Bus, chauffeurs, guichets
                'voir-bus', 'creer-bus', 'modifier-bus', 'supprimer-bus',
                'voir-chauffeur', 'creer-chauffeur', 'modifier-chauffeur', 'supprimer-chauffeur',
                'voir-guichet',

                // Trajets et arrêts
                'voir-trajet', 'creer-trajet', 'modifier-trajet', 'supprimer-trajet',
                'voir-arret', 'creer-arret', 'modifier-arret', 'supprimer-arret',
                'gerer-arrets-sur-trajet',

                // Réservations et paiements de la filiale
                'voir-reservation', 'creer-reservation', 'modifier-reservation', 'annuler-reservation',
                'voir-paiement', 'valider-paiement', 'annuler-paiement',

                'voir-rapports', 'voir-dashboard',
            ],

            'guichetier' => [
                'voir-reservation', 'creer-reservation', 'modifier-reservation', 'annuler-reservation',
                'voir-paiement', 'valider-paiement', 'annuler-paiement',
            ],

            'chauffeur' => [
                'voir-trajet', 'voir-voyage',
            ],

            'client' => [
                'creer-reservation', 'voir-reservation',
            ],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        // 3. Création du super_admin par défaut (si besoin)
        $superAdmin = User::firstOrCreate(
                ['email' => 'ctlo@gmail.com'],
                [
                    
                    'name' => 'SuperAdmin',
                    'password' => bcrypt('20031974'), // Change ce mot de passe après le seed!
                ]
            );

        $superAdmin->assignRole('super_admin');
    }
}
