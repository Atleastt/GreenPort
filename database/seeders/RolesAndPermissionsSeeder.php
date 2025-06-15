<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Contoh: Permission::create(['name' => 'edit articles']);
        // Tambahkan permissions yang dibutuhkan sesuai fitur nanti

        // create roles and assign created permissions
        Role::firstOrCreate(['name' => 'Auditor']);
        Role::firstOrCreate(['name' => 'Auditee']);
        Role::firstOrCreate(['name' => 'Admin']);
        // Contoh: $role->givePermissionTo('edit articles');
    }
}
