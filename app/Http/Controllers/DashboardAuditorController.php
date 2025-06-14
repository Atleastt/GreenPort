<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardAuditorController extends Controller
{
    public function index(): View
    {
        // Mengambil semua indikator beserta relasi subkriteria dan kriteria
        $indikators = Indikator::with('subkriteria.kriteria')->get();

        // Mengirim data ke view
        return view('pages.dashboard_auditor', [
            'indikators' => $indikators,
        ]);
    }
    //
}
