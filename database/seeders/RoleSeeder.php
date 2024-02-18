<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masterRole = Role::create(['name' => 'master']);
        $userRole = Role::create(['name' => 'user']);

        Permission::create(['name' => 'delete'])->syncRoles($masterRole, $userRole);
    }
}
