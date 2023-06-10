<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use App\Providers\RoleServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Roles::insert([
            ['libelle'=> RoleServiceProvider::ADMIN],
            ['libelle'=> RoleServiceProvider::SUPER_ADMIN],
            ['libelle'=> RoleServiceProvider::CONDUCTEUR],
            ['libelle'=> RoleServiceProvider::PASSAGER],

        ]);
    }
}
