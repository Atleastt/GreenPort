<x-app-layout>
    <div x-data="{
        uploadModalOpen: false,
        deleteModalOpen: false,
        itemToDelete: null,
        notification: { show: false, message: '' },
        showNotification(message) {
            this.notification.message = message;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 5000);
        }
    }" x-init="() => {
        @if (session('success'))
            showNotification('{{ session('success') }}');
        @endif
    }">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Page Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Bukti Pendukung Audit</h1>
                    <button @click="uploadModalOpen = true"
                        class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Unggah Dokumen
                    </button>
                </div>

                <!-- Success Notification -->
                <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2"
                    class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md"
                    role="alert" x-cloak>
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Berhasil!</p>
                            <p class="text-sm" x-text="notification.message"></p>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokumen</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terkait Temuan</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Unggah</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($documents as $doc)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $doc->nama_dokumen }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $doc->temuan->kode_temuan ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $doc->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span @class([
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                    'bg-green-100 text-green-800' => $doc->status == 'terverifikasi',
                                                    'bg-yellow-100 text-yellow-800' => $doc->status == 'menunggu verifikasi',
                                                    'bg-red-100 text-red-800' => $doc->status == 'revisi',
                                                ])>
                                                    {{ ucfirst(str_replace('_', ' ', $doc->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-3">
                                                    <a href="{{ route('bukti-pendukung.show', $doc->id) }}" target="_blank" class="text-gray-400 hover:text-emerald-600" title="Lihat">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                    <button @click="deleteModalOpen = true; itemToDelete = {{ $doc->id }}" class="text-gray-400 hover:text-red-600" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-10">
                                                <div class="flex flex-col items-center text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <h3 class="text-lg font-semibold">Belum Ada Dokumen</h3>
                                                    <p class="text-sm">Silakan unggah dokumen bukti pendukung pertama Anda.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Unggah -->
        <div x-show="uploadModalOpen" @keydown.escape.window="uploadModalOpen = false"
            class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center bg-black bg-opacity-60" x-cloak>
            <div @click.away="uploadModalOpen = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4 sm:mx-0 transform transition-all"
                x-show="uploadModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                
                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Unggah Dokumen Baru</h2>
                    <button @click="uploadModalOpen = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>

                <form action="{{ route('bukti-pendukung.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <label for="temuan_id" class="block text-sm font-medium text-gray-700">Terkait Temuan</label>
                        <select id="temuan_id" name="temuan_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" required>
                            <option value="">Pilih Temuan Terkait</option>
                            @foreach($temuans as $temuan)
                                <option value="{{ $temuan->id }}">{{ $temuan->kode_temuan }} - {{ Str::limit($temuan->ringkasan, 50) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nama_dokumen" class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" id="nama_dokumen" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" required placeholder="Contoh: Laporan Insiden Keamanan Q1">
                    </div>
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700">File Dokumen</label>
                        <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" required>
                        <p class="mt-1 text-xs text-gray-500">Tipe file: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Maks: 5MB.</p>
                    </div>
                    <div class="flex justify-end space-x-4 pt-5 border-t border-gray-200">
                        <button type="button" @click="uploadModalOpen = false" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-25 transition ease-in-out duration-150">Batal</button>
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-25 transition ease-in-out duration-150">Unggah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-show="deleteModalOpen" @keydown.escape.window="deleteModalOpen = false"
            class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center bg-black bg-opacity-60" x-cloak>
            <div @click.away="deleteModalOpen = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4 sm:mx-0 transform transition-all"
                x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                
                <div class="flex flex-col items-center text-center">
                    <div class="bg-red-100 p-3 rounded-full mb-4">
                        <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Konfirmasi Hapus</h2>
                    <p class="text-sm text-gray-600 mt-2 mb-6">Apakah Anda yakin ingin menghapus dokumen ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>

                <form :action="'/bukti-pendukung/' + itemToDelete" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" @click="deleteModalOpen = false" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">
                            Batal
                        </button>
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                            Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
