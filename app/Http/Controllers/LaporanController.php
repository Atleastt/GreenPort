<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan.
     */
    public function index()
    {
        $reports = Laporan::orderBy('created_at', 'desc')->get();
        return view('pages.pelaporan', compact('reports'));
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Laporan::create([
            'name' => $request->report_type,
            'period_start' => $request->start_date,
            'period_end' => $request->end_date,
            // 'created_at' akan diisi otomatis oleh Eloquent
        ]);

        return redirect()->route('pelaporan')->with('success', 'Laporan berhasil dibuat.');
    }
    //
}
