@extends('layouts.app')

@section('content')
<div x-data="{ deleteModalOpen: false, itemToDelete: '' }">
    <!-- Judul Halaman -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Input Bukti Pendukung</h1>
        <p class="text-sm text-gray-500">Halaman ini digunakan oleh Auditee untuk mengunggah dan mengelola dokumen bukti pendukung.</p>
    </div>

    <!-- Form Input Bukti Pendukung -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambahkan Bukti Pendukung Baru</h2>
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="indicator_id" class="block text-sm font-medium text-gray-700">Pilih Indikator</label>
                <select id="indicator_id" name="indicator_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value=""> -- Pilih Indikator Terkait -- </option>
                    <option value="1">Kepatuhan Regulasi X</option>
                    <option value="2">Prosedur Keselamatan Y</option>
                    <option value="3">Pelatihan Staf Z</option>
                </select>
            </div>

            <div>
                <label for="document_name" class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
                <input type="text" name="document_name" id="document_name" placeholder="Contoh: Sertifikat Pelatihan K3"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            </div>

            <div>
                <label for="document_file" class="block text-sm font-medium text-gray-700">Upload File Bukti</label>
                <input type="file" name="document_file" id="document_file"
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100"/>
                <p class="mt-1 text-xs text-gray-500">Format yang didukung: PDF, DOCX, XLSX, JPG, PNG. Maks: 5MB.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Bukti Pendukung yang Sudah Diunggah -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Bukti Pendukung Terunggah</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokumen</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Indikator Terkait</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Unggah</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $uploadedProofs = [
                            ['id' => 1, 'name' => 'Sertifikat ISO 9001.pdf', 'indicator' => 'Indikator A', 'date' => '2024-05-20'],
                            ['id' => 2, 'name' => 'Laporan Audit Internal Q1.docx', 'indicator' => 'Indikator B', 'date' => '2024-05-15'],
                            ['id' => 3, 'name' => 'Foto APAR Terpasang.jpg', 'indicator' => 'Indikator C', 'date' => '2024-05-10'],
                        ];
                    @endphp
                    @forelse ($uploadedProofs as $proof)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $proof['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $proof['indicator'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $proof['date'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <button @click="deleteModalOpen = true; itemToDelete = '{{ $proof['name'] }}'" class="ml-3 text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Belum ada bukti pendukung yang diunggah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModalOpen" x-cloak
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div x-show="deleteModalOpen" x-transition
             class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Bukti Pendukung?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus bukti <strong x-text="itemToDelete"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="deleteModalOpen = false; /* Add delete logic here */" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                <button @click="deleteModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection
