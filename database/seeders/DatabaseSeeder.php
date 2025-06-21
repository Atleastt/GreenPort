<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            TemuanSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ])->assignRole('Admin');

        User::factory()->create([
            'name' => 'Aom Auditor',
            'email' => 'auditor@example.com',
        ])->assignRole('Auditor');

        User::factory()->create([
            'name' => 'Aom Auditee',
            'email' => 'auditee@example.com',
        ])->assignRole('Auditee');

        // User::factory(10)->create();

        $this->call([
            KriteriaIndikatorSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
