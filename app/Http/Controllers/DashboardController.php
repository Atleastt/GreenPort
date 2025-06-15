<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $indikators = Indikator::with('subkriteria.kriteria')->get();

        $chartData = $this->prepareChartData($indikators);

        return view('dashboard', [
            'chartData' => json_encode($chartData),
        ]);
    }

    private function prepareChartData($indikators)
    {
        $kriteriaCounts = [];

        foreach ($indikators as $indikator) {
            if (isset($indikator->subkriteria->kriteria)) {
                $kriteriaName = $indikator->subkriteria->kriteria->nama_kriteria;
                if (!isset($kriteriaCounts[$kriteriaName])) {
                    $kriteriaCounts[$kriteriaName] = 0;
                }
                $kriteriaCounts[$kriteriaName]++;
            }
        }

        return [
            'labels' => array_keys($kriteriaCounts),
            'data' => array_values($kriteriaCounts),
        ];
    }
}
