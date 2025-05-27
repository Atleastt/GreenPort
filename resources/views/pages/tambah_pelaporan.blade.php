@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Buat Laporan Baru</h1>
{{--        <a href="{{ route('pelaporan') }}" class="text-sm text-emerald-600 hover:text-emerald-500 flex items-center">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />--}}
{{--            </svg>--}}
{{--            Kembali ke Daftar Laporan--}}
{{--        </a>--}}
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div>
            <label for="report_title" class="block text-sm font-medium text-gray-700">Judul Laporan</label>
            <input type="text" name="report_title" id="report_title" placeholder="Contoh: Laporan Audit Kepatuhan Triwulan 1"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
        </div>

        <div>
            <label for="report_description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
            <textarea id="report_description" name="report_description" rows="4" placeholder="Jelaskan secara singkat isi atau tujuan dari laporan ini."
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"></textarea>
        </div>

        <div>
            <label for="report_file" class="block text-sm font-medium text-gray-700">Upload File Laporan</label>
            <input type="file" name="report_file" id="report_file"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100"/>
            <p class="mt-1 text-xs text-gray-500">Format yang didukung: PDF, DOCX. Maks: 10MB.</p>
        </div>

        <div>
            <label for="report_status" class="block text-sm font-medium text-gray-700">Status Laporan</label>
            <select id="report_status" name="report_status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                <option value="Draft">Draft</option>
                <option value="Review">Untuk Direview</option>
                <option value="Final">Final</option>
            </select>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('pelaporan') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                Batal
            </a>
            <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                Simpan Laporan
            </button>
        </div>
    </form>
</div>
@endsection
