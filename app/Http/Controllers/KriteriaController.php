<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria; // Asumsi nama model adalah Kriteria

use App\Models\Subkriteria; // Menggunakan nama model yang benar

class KriteriaController extends Controller
{
    /**
     * Menampilkan form untuk membuat kriteria baru.
     */
    public function create()
    {
        return view('pages.insert_kriteria_auditor');
    }

    /**
     * Menyimpan kriteria baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kriteria' => 'required|string|max:255|unique:kriterias',
            'deskripsi_kriteria' => 'required|string',
        ]);

        // Simpan ke database
        Kriteria::create($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('kriteria.create')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk membuat sub-kriteria baru.
     */
    public function createSubKriteria()
    {
        // Mengambil semua kriteria untuk ditampilkan di dropdown
        $kriterias = Kriteria::all();
        return view('pages.insert_sub_kriteria_auditor', compact('kriterias'));
    }

    /**
     * Menyimpan sub-kriteria baru ke database.
     */
    public function storeSubKriteria(Request $request)
    {
        // Validasi input
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'deskripsi_sub_kriteria' => 'required|string',
        ]);

        // Simpan ke database menggunakan model Subkriteria
        Subkriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama_subkriteria' => $request->nama_sub_kriteria,
            'deskripsi_subkriteria' => $request->deskripsi_sub_kriteria,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('insert.sub.kriteria.auditor')->with('success', 'Sub-Kriteria berhasil ditambahkan!');
    }
}
