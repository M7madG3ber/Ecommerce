<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $role = Role::firstOrCreate([
            'name' => 'admin'
        ]);
        $role = Role::firstOrCreate([
            'name' => 'user'
        ]);
    }
}
