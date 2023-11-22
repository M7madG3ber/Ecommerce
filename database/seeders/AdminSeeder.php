<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin Account
        $admin = User::firstOrCreate(
            [
                'email' => "admin@ecommerce.com",
            ],
            [
                'name' => "Admin",
                'password' => bcrypt("123456")
            ]
        );

        // Get Admin Role
        $role = Role::where("name", "admin")->first();

        // Set Admin Role
        if ($admin != null & $role != null) {
            $admin->assignRole($role);
        }
    }
}
