@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Audit (Auditor View)</h1>
    <p class="text-gray-600">Ini adalah placeholder untuk halaman Daftar Audit dari sisi Auditor.</p>
    <p class="text-gray-600 mt-2">Konten spesifik akan ditambahkan di sini berdasarkan Figma jika ada desainnya, termasuk tabel daftar audit dan aksi yang bisa dilakukan.</p>
    
    <div class="mt-6">
        <a href="{{ route('form.buat.audit.auditor') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Buat Audit Baru (Placeholder Link)
        </a>
    </div>
@endsection
