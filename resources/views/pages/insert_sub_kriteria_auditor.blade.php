@extends('layouts.app')

@section('content')
<div x-data="{ deleteModalOpen: false, itemToDelete: null }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftarkan Sub-Kriteria Dokumen Baru</h2>
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="parent_kriteria" class="block text-sm font-medium text-gray-700">Pilih Kriteria Induk</label>
                <select id="parent_kriteria" name="parent_kriteria"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="">-- Pilih Kriteria --</option>
                    <option value="kriteria_1">Kriteria 1</option>
                    <option value="kriteria_2">Kriteria 2</option>
                    <option value="kriteria_3">Kriteria 3</option>
                </select>
            </div>
            <div>
                <label for="sub_kriteria_dokumen" class="block text-sm font-medium text-gray-700">Nama Sub-Kriteria Dokumen</label>
                <input type="text" name="sub_kriteria_dokumen" id="sub_kriteria_dokumen" placeholder="Masukan nama sub-kriteria"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-lime-500 hover:bg-lime-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-400">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Sub-Kriteria Dokumen</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-lime-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Kriteria Induk</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Sub-Kriteria Dokumen</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-emerald-800 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $subKriteriaList = [
                            ['parent' => 'Kriteria - 1', 'sub' => 'Sub-Kriteria - 1A'],
                            ['parent' => 'Kriteria - 1', 'sub' => 'Sub-Kriteria - 1B'],
                            ['parent' => 'Kriteria - 2', 'sub' => 'Sub-Kriteria - 2A'],
                            ['parent' => 'Kriteria - 3', 'sub' => 'Sub-Kriteria - 3A'],
                            ['parent' => 'Kriteria - 3', 'sub' => 'Sub-Kriteria - 3B'],
                        ];
                    @endphp
                    @foreach ($subKriteriaList as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item['parent'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item['sub'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <button @click="deleteModalOpen = true; itemToDelete = '{{ $item['sub'] }}'" class="ml-4 text-red-600 hover:text-red-800">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
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
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Hapus Sub-Kriteria?
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Apakah anda yakin untuk menghapus sub-kriteria <strong x-text="itemToDelete"></strong> ini?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="deleteModalOpen = false; /* Add delete logic here */" type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button @click="deleteModalOpen = false" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
