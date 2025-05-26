@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Dokumen</h1>
    <p class="text-gray-600">Ini adalah placeholder untuk halaman Tambah Dokumen.</p>
    <p class="text-gray-600 mt-2">Konten spesifik dan form untuk menambah dokumen akan diimplementasikan di sini berdasarkan desain Figma.</p>
    
    <div class="mt-6 bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Form Tambah Dokumen (Contoh)</h2>
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="document_name" class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
                <input type="text" name="document_name" id="document_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Masukkan nama dokumen">
            </div>
            <div>
                <label for="document_category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="document_category" name="document_category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                    <option>Pilih Kategori</option>
                    <option>Kategori A</option>
                    <option>Kategori B</option>
                </select>
            </div>
            <div>
                <label for="document_file" class="block text-sm font-medium text-gray-700">Upload File</label>
                <input type="file" name="document_file" id="document_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 mr-2">Batal</button>
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">Simpan Dokumen</button>
            </div>
        </form>
    </div>
@endsection
