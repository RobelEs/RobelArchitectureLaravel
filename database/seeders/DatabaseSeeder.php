<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Chantier;
use App\Models\Materiel;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder

{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        
        // Création des permissions
        $viewChantier = Permission::firstOrCreate(['name' => 'view chantier']);
        $createChantier = Permission::firstOrCreate(['name' => 'create chantier']);
        $updateChantier = Permission::firstOrCreate(['name' => 'update chantier']);
        $deleteChantier = Permission::firstOrCreate(['name' => 'delete chantier']);
        
        $viewMateriel = Permission::firstOrCreate(['name' => 'view materiel']);
        $createMateriel = Permission::firstOrCreate(['name' => 'create materiel']);
        $updateMateriel = Permission::firstOrCreate(['name' => 'update materiel']);
        $deleteMateriel = Permission::firstOrCreate(['name' => 'delete materiel']);
        
        $viewUser = Permission::firstOrCreate(['name' => 'view user']);
        $createUser = Permission::firstOrCreate(['name' => 'create user']);
        $updateUser = Permission::firstOrCreate(['name' => 'update user']);
        $deleteUser = Permission::firstOrCreate(['name' => 'delete user']);
        
        // Attribution des permissions aux rôles
        $adminRole->givePermissionTo([
            $viewChantier,
            $createChantier,
            $updateChantier,
            $deleteChantier,
            $viewMateriel,
            $createMateriel,
            $updateMateriel,
            $deleteMateriel,
            $viewUser,
            $createUser,
            $updateUser,
            $deleteUser
        ]);
        $userRole->givePermissionTo([
            $viewChantier,
        ]);

        // Création de 10 utilisateurs avec le rôle admin
        User::factory(10)->create()->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });
        // Création de 10 utilisateurs avec le rôle user
        User::factory(10)->create()->each(function ($user) use ($userRole) {
            $user->assignRole($userRole);
        });
        
        $users = User::factory(10)->create();
        Chantier::factory()->count(10)->create([
            'client_id' => $users->random()->id,
        ]);

        // Génération de matériels aléatoires
        Materiel::factory()->count(20)->create();

        // Génération de chantiers_employes aléatoires
        foreach (Chantier::all() as $chantier) {
            $chantier->users()->attach($users->random(rand(1, 5))->pluck('id')->toArray());
        }
            // Génération de chantier_materiels aléatoires
        foreach (Chantier::all() as $chantier) {
            $materiels = Materiel::all()->random(rand(1, 5));  // Sélectionner un nombre aléatoire de matériels
            $attachements = [];

            foreach ($materiels as $materiel) {
                $attachements[$materiel->id] = [
                    'quantite_utilisee' => rand(1, 10) // Attribuer une quantité aléatoire
                ];
            }

            $chantier->materiels()->attach($attachements);
        }

    
 

    }
}
