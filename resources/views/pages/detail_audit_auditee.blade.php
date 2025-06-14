<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Audit: Kepatuhan SOP Logistik') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'temuan' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Info Audit -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Audit</h3>
                        <p class="mt-1 text-md font-semibold text-gray-900 dark:text-gray-100">Audit Kepatuhan SOP Logistik</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Periode</h3>
                        <p class="mt-1 text-md font-semibold text-gray-900 dark:text-gray-100">1 Agu 2024 - 30 Agu 2024</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Auditor Utama</h3>
                        <p class="mt-1 text-md font-semibold text-gray-900 dark:text-gray-100">John Doe</p>
                    </div>
                </div>
            </div>

            <!-- Navigasi Tab -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-6 px-6" aria-label="Tabs">
                        <a href="#"
                           @click.prevent="tab = 'temuan'"
                           :class="{'border-indigo-500 text-indigo-600': tab === 'temuan', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'temuan'}"
                           class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Temuan & Tindak Lanjut
                        </a>
                        <a href="#"
                           @click.prevent="tab = 'dokumen'"
                           :class="{'border-indigo-500 text-indigo-600': tab === 'dokumen', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'dokumen'}"
                           class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Dokumen Terkait
                        </a>
                    </nav>
                </div>

                <!-- Konten Tab -->
                <div class="p-6">
                    <!-- Tab Temuan -->
                    <div x-show="tab === 'temuan'" class="space-y-4">
                        <div class="p-4 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 rounded-r-lg">
                            <h5 class="font-semibold text-red-800 dark:text-red-300">Temuan Mayor: TM-001</h5>
                            <p class="mt-1 text-gray-700 dark:text-gray-300">Pencatatan logistik tidak sesuai SOP. Diperlukan pelatihan ulang.</p>
                            <div class="mt-2">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Unggah Bukti Tindak Lanjut</a>
                            </div>
                        </div>
                        <div class="p-4 border-l-4 border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20 rounded-r-lg">
                            <h5 class="font-semibold text-yellow-800 dark:text-yellow-300">Temuan Minor: TN-001</h5>
                            <p class="mt-1 text-gray-700 dark:text-gray-300">Formulir ATK tidak diisi lengkap.</p>
                             <div class="mt-2">
                                <span class="text-sm text-green-600">Tindak Lanjut Selesai</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Dokumen -->
                    <div x-show="tab === 'dokumen'" class="hidden">
                       <p class="text-gray-700 dark:text-gray-300">Daftar dokumen yang diminta dan diunggah akan muncul di sini.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@section('content')
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Detail Audit (Auditee View)</h1>
    <p class="text-gray-600">Ini adalah placeholder untuk halaman Detail Audit dengan Checklist dari sisi Auditee (untuk pengisian).</p>
    <p class="text-gray-600 mt-2">Konten spesifik akan ditambahkan di sini berdasarkan Figma jika ada desainnya, termasuk checklist audit dan form input.</p>
    
    <div class="mt-6">
        <a href="{{ route('dashboard.auditee') }}" class="text-blue-600 hover:underline">
            &larr; Kembali ke Dashboard Auditee (Placeholder Link)
        </a>
    </div>
@endsection
