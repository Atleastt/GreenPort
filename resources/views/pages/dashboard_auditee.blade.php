@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Dashboard Auditee</h1>
    <p class="text-gray-600">Ini adalah placeholder untuk Dashboard Auditee.</p>
    <p class="text-gray-600 mt-2">Konten spesifik halaman dashboard auditee akan ditambahkan di sini berdasarkan Figma jika ada desainnya.</p>
    
    {{-- Contoh link ke halaman lain yang relevan untuk Auditee --}}
    <div class="mt-6">
        <h2 class="text-xl font-medium text-gray-700 mb-2">Akses Cepat:</h2>
        <ul class="list-disc list-inside space-y-1">
            <li><a href="{{ route('bukti.pendukung.auditee') }}" class="text-blue-600 hover:underline">Input Bukti Pendukung</a></li>
            <li><a href="{{ route('detail.audit.auditee') }}" class="text-blue-600 hover:underline">Lihat Detail Audit (Placeholder)</a></li>
            {{-- Tambahkan link lain sesuai kebutuhan --}}
        </ul>
    </div>
@endsection
