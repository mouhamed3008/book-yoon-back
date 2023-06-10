<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Providers\RoleServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superAdmin = Roles::where('libelle', RoleServiceProvider::SUPER_ADMIN)->pluck('id')->first();
        $conducteur = Roles::where('libelle', RoleServiceProvider::CONDUCTEUR)->pluck('id')->first();
        $passager = Roles::where('libelle', RoleServiceProvider::PASSAGER)->pluck('id')->first();
        User::factory()->create([
            'name' => 'Admin',
            'telephone' => '778338123',
            'email' => 'admin@gmail.com',
            'adresse' => 'guediawaye',
            'date_naissance' => '30 aout 2020',
            'role_id' => $superAdmin,
        ]);

        User::factory()->create([
            'name' => 'conducteur',
            'telephone' => '777777777',
            'email' => 'conducteur@gmail.com',
            'adresse' => 'guediawaye',
            'date_naissance' => '30 aout 2020',
            'role_id' => $conducteur,
        ]);

        User::factory()->create([
            'name' => 'passager',
            'telephone' => '123456789',
            'email' => 'passager@gmail.com',
            'adresse' => 'guediawaye',
            'date_naissance' => '30 aout 2020',
            'role_id' => $passager,
        ]);


    }
}
