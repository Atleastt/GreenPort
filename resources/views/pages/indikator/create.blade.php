<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Tambah Indikator Baru</h2>

                    <form action="{{ route('indikator.store') }}" method="POST">
                        @csrf

                        <!-- Sub Kriteria -->
                        <div class="mb-4">
                            <label for="subkriteria_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sub Kriteria</label>
                            <select id="subkriteria_id" name="subkriteria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                <option value="">Pilih Sub Kriteria</option>
                                @foreach($subkriterias as $subkriteria)
                                    <option value="{{ $subkriteria->id }}" {{ old('subkriteria_id') == $subkriteria->id ? 'selected' : '' }}>{{ $subkriteria->kriteria->nama_kriteria }} &raquo; {{ $subkriteria->nama_subkriteria }}</option>
                                @endforeach
                            </select>
                            @error('subkriteria_id')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teks Indikator -->
                        <div class="mb-4">
                            <label for="teks_indikator" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teks Indikator</label>
                            <textarea id="teks_indikator" name="teks_indikator" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>{{ old('teks_indikator') }}</textarea>
                             @error('teks_indikator')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bobot Indikator -->
                        <div class="mb-4">
                            <label for="bobot_indikator" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bobot (%)</label>
                            <input type="number" id="bobot_indikator" name="bobot_indikator" value="{{ old('bobot_indikator') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                             @error('bobot_indikator')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Poin Maksimal Indikator -->
                        <div class="mb-4">
                            <label for="poin_maks_indikator" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poin Maksimal</label>
                            <input type="number" id="poin_maks_indikator" name="poin_maks_indikator" value="{{ old('poin_maks_indikator') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                             @error('poin_maks_indikator')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('dashboard.auditor') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mr-4">Batal</a>
                            <button type="submit" class="bg-lime-500 hover:bg-lime-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm">
                                Simpan Indikator
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
