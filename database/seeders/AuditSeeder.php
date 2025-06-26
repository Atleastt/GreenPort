<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Audit;
use App\Models\User;
use Carbon\Carbon;

class AuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auditor = User::role('Auditor')->first();
        $auditee = User::role('Auditee')->first();

        // Scheduled audit
        Audit::updateOrCreate(
            ['judul' => 'Audit Keamanan Sistem'],
            [
                'auditor_id'    => $auditor->id,
                'auditee_id'    => $auditee->id,
                'tanggal_jadwal'=> Carbon::now()->addDays(7),
                'status'        => 'Dijadwalkan',
            ]
        );

        // Ongoing audit
        Audit::updateOrCreate(
            ['judul' => 'Audit Proses Operasional'],
            [
                'auditor_id'    => $auditor->id,
                'auditee_id'    => $auditee->id,
                'tanggal_jadwal'=> Carbon::now()->subDays(1),
                'status'        => 'Berlangsung',
            ]
        );

        // Completed audit
        Audit::updateOrCreate(
            ['judul' => 'Audit Kepatuhan Lingkungan'],
            [
                'auditor_id'    => $auditor->id,
                'auditee_id'    => $auditee->id,
                'tanggal_jadwal'=> Carbon::now()->subDays(30),
                'status'        => 'Selesai',
            ]
        );
    }
} 