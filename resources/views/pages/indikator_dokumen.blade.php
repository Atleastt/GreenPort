@extends('layouts.app')

@section('content')
<div x-data="{ deleteModalOpen: false, itemToDelete: '' }">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Indikator Dokumen</h1>
        {{-- <button @click="addModalOpen = true" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm text-sm">Tambah Indikator</button> --}}
    </div>

    <!-- Form Tambah Indikator -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambahkan Indikator Baru</h2>
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="indicator_name" class="block text-sm font-medium text-gray-700">Nama Indikator</label>
                <input type="text" name="indicator_name" id="indicator_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Kebersihan Area Dermaga">
            </div>
            <div>
                <label for="indicator_description" class="block text-sm font-medium text-gray-700">Deskripsi Indikator (Opsional)</label>
                <textarea name="indicator_description" id="indicator_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Deskripsi singkat mengenai indikator ini"></textarea>
            </div>
            <div>
                <label for="indicator_category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="indicator_category" name="indicator_category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                    <option value="">Pilih Kategori</option>
                    <option value="Environment">Environment</option>
                    <option value="Safety">Safety</option>
                    <option value="Operational">Operational</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 text-sm font-semibold">Simpan Indikator</button>
            </div>
        </form>
    </div>

    <!-- Daftar Indikator -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Indikator Dokumen</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Indikator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $indicators = [
                            ['id' => 1, 'name' => 'Pengelolaan Limbah B3', 'category' => 'Environment', 'description' => 'Memastikan limbah B3 dikelola sesuai standar.'],
                            ['id' => 2, 'name' => 'Penggunaan APD', 'category' => 'Safety', 'description' => 'Kepatuhan penggunaan Alat Pelindung Diri oleh pekerja.'],
                            ['id' => 3, 'name' => 'Efisiensi Bongkar Muat', 'category' => 'Operational', 'description' => 'Waktu rata-rata untuk proses bongkar muat barang.'],
                            ['id' => 4, 'name' => 'Ketersediaan Peralatan Pemadam Kebakaran', 'category' => 'Safety', 'description' => 'Pengecekan jumlah dan kondisi APAR.'],
                        ];
                    @endphp
                    @forelse ($indicators as $indicator)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $indicator['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $indicator['category'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($indicator['description'], 70) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <button @click="deleteModalOpen = true; itemToDelete = '{{ $indicator['name'] }}'" class="ml-3 text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Tidak ada data indikator.</td>
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
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Indikator?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus indikator <strong x-text="itemToDelete"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
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
